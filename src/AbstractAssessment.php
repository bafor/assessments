<?php
declare(strict_types=1);

namespace System;

use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationResult;

readonly abstract class AbstractAssessment
{
    public function __construct(protected Evaluation $evaluation)
    {
    }

    public function rating(): EvaluationResult // todo separate it from Evaluation result
    {
        return $this->evaluation->evaluationResult;
    }

}