<?php
declare(strict_types=1);

namespace System\Assessment;

use System\LockReason;

final readonly class Assessment extends AbstractAssessment
{
    public function suspend(LockReason $lockReason): SuspendedAssessment
    {
        return new SuspendedAssessment($this, $lockReason);
    }

    public function withdraw(LockReason $lockReason): WithdrawnAssessment
    {
        return new WithdrawnAssessment($this, $lockReason);
    }
}