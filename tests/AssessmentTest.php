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
        self::assertFalse($assessment->isExpired());
    }

    /** @test */
    public function shouldHasRatingBasedOnEvaluationResult(): void
    {
        $evaluationResult     = EvaluationResult::Positive;
        $assessment = new Assessment(EvaluationBuilder::new()->withEvaluationResult($evaluationResult)->build());

        self::assertInstanceOf(Assessment::class, $assessment);
        self::assertEquals($evaluationResult, $assessment->rating());

    }

    /** @test */
    public function shouldExpireAfterEvaluationExceeded(): void
    {
        $evaluationDate = EvaluationDateBuilder::new()
                                               ->daysAgo(Assessment::EXPIRATION_DAYS + 1)
                                               ->build();

        $assessment = new Assessment(
            EvaluationBuilder::new()->withEvaluationDate($evaluationDate)->build()
        );

        self::assertTrue($assessment->isExpired());
    }

    /** @test */
    public function shouldBeValidWithOnTheLastDay(): void
    {
        $evaluationDate = EvaluationDateBuilder::new()
                                               ->daysAgo(Assessment::EXPIRATION_DAYS)
                                               ->build();

        $assessment = new Assessment(
            EvaluationBuilder::new()->withEvaluationDate($evaluationDate)->build()
        );

        self::assertFalse($assessment->isExpired());
    }


}
