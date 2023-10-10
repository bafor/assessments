<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Evaluation;
use System\EvaluationResult;
use System\Supervisor;
use Tests\Util\EvaluationDateBuilder;

class EvaluationTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $evaluationResult = EvaluationResult::Positive;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->now()->build(),
            supervisor      : $this->mockSupervisor(),
            evaluationResult: $evaluationResult
        );

        self::assertInstanceOf(Evaluation::class, $evaluation);
        self::assertSame($evaluationResult, $evaluation->evaluationResult);
    }


    private function mockSupervisor(): Supervisor
    {
        return new class() implements Supervisor {
        };
    }
}
