<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\Assessment;
use System\Assessment\SuspendedAssessment;
use System\Assessment\WithdrawnAssessment;
use System\Evaluation\EvaluationResult;
use System\LockReason;
use System\Standard\Standard;
use Tests\Util\EvaluationBuilder;
use Tests\Util\StandardBuilder;

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

        $evaluationResult     = EvaluationResult::Positive;
        $assessment = new Assessment($this->standard, EvaluationBuilder::new()->withEvaluationResult($evaluationResult)->build());

        self::assertEquals($evaluationResult, $assessment->rating());
    }

    /** @test */
    public function shouldHavePossibilityToBeSuspended(): void
    {
        // BR 10. It is possible to lock the assessment by suspension or withdrawn.

        $assessment          = $this->createAssessment();
        $lockReason          = new LockReason('rules violation');

        $suspendedAssessment = $assessment->suspend($lockReason);

        self::assertInstanceOf(SuspendedAssessment::class, $suspendedAssessment);
        self::assertEquals($lockReason, $suspendedAssessment->lockReason);
    }

    /** @test */
    public function shouldHavePossibilityToBeWithdrawn(): void
    {
        // BR 10. It is possible to lock the assessment by suspension or withdrawn.

        $assessment          = $this->createAssessment();
        $lockReason          = new LockReason('big rules violation');

        $withdrawnAssessment = $assessment->withdraw($lockReason);

        self::assertInstanceOf(WithdrawnAssessment::class, $withdrawnAssessment);
        self::assertEquals($lockReason, $withdrawnAssessment->lockReason);
    }

    private function createAssessment(): Assessment
    {
        return new Assessment($this->standard, EvaluationBuilder::new()->build());
    }

}
