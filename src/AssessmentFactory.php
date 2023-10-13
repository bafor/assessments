<?php
declare(strict_types=1);

namespace System;

use System\Assessment\AbstractAssessment;
use System\Assessment\Assessment;
use System\Assessment\ExpiredAssessment;
use System\Evaluation\Evaluation;
use System\Standard\Standard;

class AssessmentFactory
{
    public function make(Standard $standard, Evaluation $evaluation): AbstractAssessment
    {
        $expirationDate = new ExpirationDate($evaluation->evaluationDate);

        if ($expirationDate->isExceeded()) {
            return new ExpiredAssessment($standard, $evaluation);
        }

        return new Assessment($standard, $evaluation);
    }
}