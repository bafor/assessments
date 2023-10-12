<?php
declare(strict_types=1);

namespace System;

readonly class Assessment extends AbstractAssessment
{
    public function suspend(LockReason $lockReason): SuspendedAssessment
    {
        return new SuspendedAssessment($this, $lockReason);
    }
}