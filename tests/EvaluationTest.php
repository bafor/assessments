<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Evaluation;
use System\Supervisor;
use Tests\Util\EvaluationDateBuilder;

class EvaluationTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $evaluation = new Evaluation(
            evaluationDate: EvaluationDateBuilder::new()->now()->build(),
            supervisor    : $this->mockSupervisor()
        );

        self::assertInstanceOf(Evaluation::class, $evaluation);
        self::assertFalse($evaluation->isExpired());
    }

    /** @test */
    public function shouldBeValidOnTheLastDayOfExpirationCountingFromNextDateAfterEvolutionTookPlace(): void
    {
        $evaluationDate = EvaluationDateBuilder::new()
                                               ->daysAgo(Evaluation::EXPIRATION_DATE_IN_DAYS + 1)
                                               ->build();

        $evaluation = new Evaluation(
            evaluationDate: $evaluationDate,
            supervisor    : $this->mockSupervisor()
        );

        self::assertFalse($evaluation->isExpired());
    }

    /** @test */
    public function shouldExpiredAfterAfterExpirationDate(): void
    {
        $evaluationDate = EvaluationDateBuilder::new()
                                               ->daysAgo(Evaluation::EXPIRATION_DATE_IN_DAYS + 2)
                                               ->build();

        $evaluation = new Evaluation(
            evaluationDate: $evaluationDate,
            supervisor    : $this->mockSupervisor()
        );

        self::assertTrue($evaluation->isExpired());
    }

    private function mockSupervisor(): Supervisor
    {
        return new class() implements Supervisor {
        };
    }
}
