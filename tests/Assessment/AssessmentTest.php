<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\Assessment;
use System\Assessment\SuspendedAssessment;
use System\Assessment\WithdrawnAssessment;
use System\AssessmentCanNotBeEvaluatedUntil;
use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationResult;
use System\LockReason;
use System\Standard\Standard;
use System\SupervisorHasNoAuthorityInStandard;
use Tests\Util\EvaluationBuilder;
use Tests\Util\StandardBuilder;
use Tests\Util\SupervisorBuilder;

class AssessmentTest extends TestCase
{
    private Standard $standard;

    protected function setUp(): void
    {
        parent::setUp();

        $this->standard = StandardBuilder::new()->build();
    }

    /** @test */
    public function shouldCreate(): void
    {
        // BR 1. The system allows the recording of assessments carried out with their evaluations.

        $assessment = new Assessment($this->standard, EvaluationBuilder::new()->build());

        self::assertEquals($this->standard, $assessment->standard);
    }

    /** @test */
    public function shouldHasRatingBasedOnEvaluationResult(): void
    {
        // BR 8. Upon completion of evaluation the assessment can have positive or negative ratings.

        $evaluationResult = EvaluationResult::Positive;
        $assessment       = new Assessment($this->standard, EvaluationBuilder::new()->withEvaluationResult($evaluationResult)->build());

        self::assertEquals($evaluationResult, $assessment->rating());
    }

    /** @test */
    public function shouldHavePossibilityToBeSuspended(): void
    {
        // BR 10. It is possible to lock the assessment by suspension or withdrawn.

        $assessment = $this->createAssessment();
        $lockReason = new LockReason('rules violation');

        $suspendedAssessment = $assessment->suspend($lockReason);

        self::assertInstanceOf(SuspendedAssessment::class, $suspendedAssessment);
        self::assertEquals($lockReason, $suspendedAssessment->lockReason);
    }

    /** @test */
    public function shouldHavePossibilityToBeWithdrawn(): void
    {
        // BR 10. It is possible to lock the assessment by suspension or withdrawn.

        $assessment = $this->createAssessment();
        $lockReason = new LockReason('big rules violation');

        $withdrawnAssessment = $assessment->withdraw($lockReason);

        self::assertInstanceOf(WithdrawnAssessment::class, $withdrawnAssessment);
        self::assertEquals($lockReason, $withdrawnAssessment->lockReason);
    }

    /** @test */
    public function itCanNotBeRevaluateBySupervisorWithoutAuthority(): void
    {
        $assessment = $this->createAssessment(EvaluationBuilder::new()->tookPlaceDaysAgo(days: 500)->build());
        $supervisor = SupervisorBuilder::new()->withNoAuthority()->build();

        $this->expectException(SupervisorHasNoAuthorityInStandard::class);
        $assessment->evaluate($supervisor, result: EvaluationResult::Positive);
    }

    /** @test */
    public function itCanBeRevaluateBySupervisorWithAuthority(): void
    {
        $previousEvaluation = EvaluationBuilder::new()
                                               ->tookPlaceDaysAgo(days: 500)
                                               ->withEvaluationResult(EvaluationResult::Negative)
                                               ->build();

        $assessment = $this->createAssessment($previousEvaluation);
        $supervisor = SupervisorBuilder::new()->withAuthorityInAllStandards()->build();

        $evaluatedAssessment = $assessment->evaluate($supervisor, result: EvaluationResult::Positive);

        self::assertSame(EvaluationResult::Positive, $evaluatedAssessment->rating());
    }

    /** @test */
    public function itCanNotBeRevaluateBeforeRequireDate(): void
    {
        // BR 19. Subsequent evaluation may be conducted after a period of not less than 180
        //days for evaluation completed with a positive result and 30 days for evaluation
        //completed with a negative result

        $previousEvaluation = EvaluationBuilder::new()
                                               ->tookPlaceDaysAgo(days: 2)
                                               ->withEvaluationResult(EvaluationResult::Negative)
                                               ->build();

        $assessment = $this->createAssessment($previousEvaluation);
        $supervisor = SupervisorBuilder::new()->withAuthorityInAllStandards()->build();

        $this->expectException(AssessmentCanNotBeEvaluatedUntil::class);

        $assessment->evaluate($supervisor, result: EvaluationResult::Positive);
    }

    private function createAssessment(?Evaluation $evaluation = null): Assessment
    {
        $evaluation ??= EvaluationBuilder::new()->build();

        return new Assessment($this->standard, $evaluation);
    }

}
