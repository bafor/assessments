<?php
declare(strict_types=1);

namespace System\Evaluation;

use System\Supervisor;

readonly class Evaluation
{

    public function __construct(
        public EvaluationDate $evaluationDate,
        private Supervisor         $supervisor,
        public EvaluationResult   $evaluationResult
    )
    {
    }

}