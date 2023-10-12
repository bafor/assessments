<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\ExpirationDate;
use Tests\Util\EvaluationDateBuilder;

// BR9 The assessment has an expiration date of 365 days counting from the day
// evaluation took place. After it is exceeded, the assessment expires.
class ExpirationDateTest extends TestCase
{
    /** @test */
    public function shouldCreate(): void
    {
        $expirationDate = new ExpirationDate(EvaluationDateBuilder::new()->build());

        self::assertInstanceOf(ExpirationDate::class, $expirationDate);
    }

    /** @test */
    public function shouldExpiredAfter366Days(): void
    {
        $evaluationDate = EvaluationDateBuilder::new()
                                               ->daysAgo(ExpirationDate::EXPIRATION_DAYS + 1)
                                               ->build();

        $expirationDate = new ExpirationDate($evaluationDate);

        self::assertTrue($expirationDate->isExceeded());
    }

    /** @test */
    public function shouldBeValidWithOnTheLastDay(): void
    {
        $evaluationDate = EvaluationDateBuilder::new()
                                               ->daysAgo(ExpirationDate::EXPIRATION_DAYS)
                                               ->build();

        $expirationDate = new ExpirationDate($evaluationDate);

        self::assertFalse($expirationDate->isExceeded());
    }

}
