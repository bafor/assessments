<?php
declare(strict_types=1);

namespace System;

use System\Assessment\AbstractAssessment;
use System\Assessment\Assessment;
use System\Assessment\ExpiredAssessment;
use System\Evaluation\Evaluation;

class AssessmentFactory
{
    public function make(Evaluation $evaluation): AbstractAssessment
    {
        $expirationDate = new ExpirationDate($evaluation->evaluationDate);

        if ($expirationDate->isExceeded()) {
            return new ExpiredAssessment($evaluation);
        }

        return new Assessment($evaluation);
    }
}