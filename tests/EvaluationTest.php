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

    private function mockSupervisor(): Supervisor
    {
        return new class() implements Supervisor {};
    }
}
