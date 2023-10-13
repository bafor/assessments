<?php
declare(strict_types=1);

namespace Tests\Evaluation;

use PHPUnit\Framework\TestCase;
use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationResult;
use System\Supervisor;
use Tests\Util\EvaluationDateBuilder;
use Tests\Util\SupervisorBuilder;

class EvaluationTest extends TestCase
{
    private Supervisor $supervisor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supervisor = SupervisorBuilder::new()->build();
    }

    /** @test */
    public function shouldCreate(): void
    {
        // BR 2. The evaluation is carried out by the Supervisor.

        $evaluationResult = EvaluationResult::Positive;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->now()->build(),
            supervisor      : $this->supervisor,
            evaluationResult: $evaluationResult
        );

        self::assertSame($evaluationResult, $evaluation->evaluationResult);
    }

    /** @test */
    public function itCanBeRevaluateAfter180DaysAndPositiveResult(): void
    {
        // BR 19. Subsequent evaluation may be conducted after a period of not less than 180
        //days for evaluation completed with a positive result and 30 days for evaluation
        //completed with a negative result

        $evaluationResult = EvaluationResult::Positive;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->daysAgo(180)->build(),
            supervisor      : $this->supervisor,
            evaluationResult: $evaluationResult
        );

        self::assertTrue($evaluation->canBeRevaluate());
    }

    /** @test */
    public function itCanNotBeRevaluateBefore180DaysAndPositiveResult(): void
    {
        // BR 19. Subsequent evaluation may be conducted after a period of not less than 180
        //days for evaluation completed with a positive result and 30 days for evaluation
        //completed with a negative result

        $evaluationResult = EvaluationResult::Positive;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->daysAgo(44)->build(),
            supervisor      : $this->supervisor,
            evaluationResult: $evaluationResult
        );

        self::assertFalse($evaluation->canBeRevaluate());
    }

    /** @test */
    public function itCanNotBeRevaluateBefore30DaysAndNegativeResult(): void
    {
        // BR 19. Subsequent evaluation may be conducted after a period of not less than 180
        //days for evaluation completed with a positive result and 30 days for evaluation
        //completed with a negative result


        $evaluationResult = EvaluationResult::Negative;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->daysAgo(1)->build(),
            supervisor      : $this->supervisor,
            evaluationResult: $evaluationResult
        );

        self::assertFalse($evaluation->canBeRevaluate());
    }

    /** @test */
    public function itCanNotBeRevaluateAfter30DaysAndNegativeResult(): void
    {
        // BR 19. Subsequent evaluation may be conducted after a period of not less than 180
        //days for evaluation completed with a positive result and 30 days for evaluation
        //completed with a negative result


        $evaluationResult = EvaluationResult::Negative;

        $evaluation = new Evaluation(
            evaluationDate  : EvaluationDateBuilder::new()->daysAgo(31)->build(),
            supervisor      : $this->supervisor,
            evaluationResult: $evaluationResult
        );

        self::assertTrue($evaluation->canBeRevaluate());
    }


}
