<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment;
use System\Evaluation;
use System\Supervisor;

class EvaluationTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $evaluation = new Evaluation(
            evaluationDate: new \DateTimeImmutable(),
            supervisor    : $this->mockSupervisor()
        );

        self::assertInstanceOf(Evaluation::class, $evaluation);
        self::assertFalse($evaluation->isExpired());
    }

    /** @test */
    public function shouldBeValidOnTheLastDayOfExpirationCountingFromNextDateAfterEvolutionTookPlace(): void
    {
        $evaluationDate = new \DateTimeImmutable(Evaluation::EXPIRATION_DATE_IN_DAYS + 1 . ' days ago');

        $evaluation = new Evaluation(
            evaluationDate: $evaluationDate,
            supervisor    : $this->mockSupervisor()
        );

        self::assertFalse($evaluation->isExpired());
    }

    /** @test */
    public function shouldExpiredAfterAfterExpirationDate(): void
    {
        $evaluation = new Evaluation(
            evaluationDate: new \DateTimeImmutable(Evaluation::EXPIRATION_DATE_IN_DAYS + 2 . ' days ago'),
            supervisor    : $this->mockSupervisor()
        );

        self::assertTrue($evaluation->isExpired());

    }

    private function mockSupervisor(): Supervisor
    {
        return new class() implements Supervisor {};
    }
}
