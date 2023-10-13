<?php
declare(strict_types=1);

namespace System\Assessment;

use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationResult;
use System\Standard;

readonly abstract class AbstractAssessment
{
    public function __construct(public Standard $standard, protected Evaluation $evaluation)
    {
    }

    public function rating(): EvaluationResult // todo separate it from Evaluation result
    {
        return $this->evaluation->evaluationResult;
    }

}