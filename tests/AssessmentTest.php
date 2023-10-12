<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment;
use System\EvaluationResult;
use Tests\Util\EvaluationBuilder;
use Tests\Util\EvaluationDateBuilder;

class AssessmentTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new Assessment(EvaluationBuilder::new()->build());

        self::assertInstanceOf(Assessment::class, $assessment);
    }

    /** @test */
    public function shouldHasRatingBasedOnEvaluationResult(): void
    {
        $evaluationResult     = EvaluationResult::Positive;
        $assessment = new Assessment(EvaluationBuilder::new()->withEvaluationResult($evaluationResult)->build());

        self::assertInstanceOf(Assessment::class, $assessment);
        self::assertEquals($evaluationResult, $assessment->rating());

    }

}
