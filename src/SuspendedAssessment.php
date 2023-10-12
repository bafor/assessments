<?php
declare(strict_types=1);

namespace System;

readonly class SuspendedAssessment extends AbstractAssessment
{
    public function __construct(Assessment $assessment, public LockReason $lockReason)
    {
        parent::__construct($assessment->evaluation);
    }
}