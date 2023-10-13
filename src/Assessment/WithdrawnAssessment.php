<?php
declare(strict_types=1);

namespace System\Assessment;

use System\LockReason;

final readonly class WithdrawnAssessment extends AbstractAssessment
{
    public function __construct(Assessment|SuspendedAssessment $assessment, public LockReason $lockReason)
    {
        parent::__construct($assessment->standard, $assessment->evaluation);
    }
}