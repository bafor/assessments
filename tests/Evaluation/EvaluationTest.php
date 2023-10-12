<?php
declare(strict_types=1);

namespace Tests\Evaluation;

use PHPUnit\Framework\TestCase;
use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationResult;
use Tests\Util\EvaluationDateBuilder;
use Tests\Util\SupervisorBuilder;

class EvaluationTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        // BR 2. The evaluation is carried out by the Supervisor.

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
