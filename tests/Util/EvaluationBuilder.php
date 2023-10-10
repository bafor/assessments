<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Evaluation;
use System\EvaluationDate;
use System\EvaluationResult;
use System\Supervisor;

class EvaluationBuilder
{
    private Supervisor $supervisor;

    private function __construct(
        private \DateTimeImmutable $evaluationDate = new \DateTimeImmutable(),
        private EvaluationResult   $evaluationResult = EvaluationResult::Positive
    )
    {
        $this->supervisor       = new class() implements Supervisor {
        };
        $this->evaluationResult = EvaluationResult::Positive;
    }

    public
    static function new(): self
    {
        return new self();
    }

    public function build(): Evaluation
    {
        return new Evaluation(
            evaluationDate  : new EvaluationDate($this->evaluationDate),
            supervisor      : $this->supervisor,
            evaluationResult: $this->evaluationResult
        );
    }
}