<?php
declare(strict_types=1);

namespace System;

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