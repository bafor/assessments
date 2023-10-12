<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationDate;
use System\Evaluation\EvaluationResult;
use System\Supervisor;

class EvaluationBuilder
{
    private Supervisor $supervisor;

    private function __construct(
        private \DateTimeImmutable $evaluationDate = new \DateTimeImmutable(),
        private EvaluationResult   $evaluationResult = EvaluationResult::Positive
    )
    {
        $this->supervisor = SupervisorBuilder::new()->build();
    }

    public static function new(): self
    {
        return new self();
    }

    public function withEvaluationResult(EvaluationResult $result): self
    {
        $this->evaluationResult = $result;
        return $this;
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