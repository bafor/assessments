<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Evaluation;
use System\EvaluationResult;
use System\Supervisor;
use Tests\Util\EvaluationDateBuilder;
use Tests\Util\SupervisorBuilder;

class EvaluationTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $evaluationResult = EvaluationResult::Positive;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->now()->build(),
            supervisor      : SupervisorBuilder::new()->build(),
            evaluationResult: $evaluationResult
        );

        self::assertInstanceOf(Evaluation::class, $evaluation);
        self::assertSame($evaluationResult, $evaluation->evaluationResult);
    }
}
