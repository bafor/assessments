<?php
declare(strict_types=1);

namespace System;

readonly abstract class AbstractAssessment
{
    public function __construct(private Evaluation $evaluation)
    {
    }

    public function rating(): EvaluationResult // todo It separated from Evaluation result
    {
        return $this->evaluation->evaluationResult;
    }

}