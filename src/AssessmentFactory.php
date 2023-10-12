<?php
declare(strict_types=1);

namespace System;

class AssessmentFactory
{

    public function create(Evaluation $evaluation): AbstractAssessment
    {
        return new Assessment($evaluation);
    }
}