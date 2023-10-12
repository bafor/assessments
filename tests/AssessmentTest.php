<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment;
use System\Evaluation\EvaluationResult;
use System\LockReason;
use System\SuspendedAssessment;
use Tests\Util\EvaluationBuilder;

class AssessmentTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        // BR 1. The system allows the recording of assessments carried out with their evaluations.

        $assessment = new Assessment(EvaluationBuilder::new()->build());

        self::assertInstanceOf(Assessment::class, $assessment);
    }

    /** @test */
    public function shouldHasRatingBasedOnEvaluationResult(): void
    {
        // BR 8. Upon completion of evaluation the assessment can have positive or negative ratings.

        $evaluationResult     = EvaluationResult::Positive;
        $assessment = new Assessment(EvaluationBuilder::new()->withEvaluationResult($evaluationResult)->build());

        self::assertInstanceOf(Assessment::class, $assessment);
        self::assertEquals($evaluationResult, $assessment->rating());

    }

    /** @test */
    public function shouldHavePossibilityToBeSuspended(): void
    {
        // BR 10. It is possible to lock the assessment by suspension or withdrawn.

        $assessment          = new Assessment(EvaluationBuilder::new()->build());
        $lockReason          = new LockReason('rules violation');

        $suspendedAssessment = $assessment->suspend($lockReason);

        self::assertInstanceOf(SuspendedAssessment::class, $suspendedAssessment);
        self::assertEquals($lockReason, $suspendedAssessment->lockReason);
    }

}
