<?php
declare(strict_types=1);

namespace System\Evaluation;

use System\Supervisor;

readonly class Evaluation
{
    public function __construct(
        public EvaluationDate   $evaluationDate,
        private Supervisor      $supervisor,
        public EvaluationResult $evaluationResult
    )
    {
    }

    public function canBeRevaluate(): bool
    {
        if ($this->evaluationResult === EvaluationResult::Positive) {

            if ($this->evaluationDate->daysSinceEvaluation() >= 180) {
                return true;
            }

            return false;
        }

        if ($this->evaluationResult === EvaluationResult::Negative) {

            if ($this->evaluationDate->daysSinceEvaluation() >= 30) {
                return true;
            }

            return false;
        }

        return false;
    }

}