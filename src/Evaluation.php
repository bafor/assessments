<?php
declare(strict_types=1);

namespace System;

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