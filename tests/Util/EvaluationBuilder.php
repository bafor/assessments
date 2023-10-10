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
        $this->supervisor = new class() implements Supervisor {
        };

    }

    public static function new(): self
    {
        return new self();
    }

    public function withEvaluationDate(EvaluationDate $evaluationDate): self
    {
        $this->evaluationDate = $evaluationDate->evaluationDate;
        return $this;
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