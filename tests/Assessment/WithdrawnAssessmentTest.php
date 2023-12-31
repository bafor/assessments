<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\SuspendedAssessment;
use System\Assessment\WithdrawnAssessment;
use System\LockReason;
use Tests\Util\AssessmentBuilder;

class WithdrawnAssessmentTest extends TestCase
{
    /** @test */
    public function shouldCreateFromAssessment(): void
    {
        $assessment = new WithdrawnAssessment(AssessmentBuilder::new()->build(), new LockReason('very avg reason'));

        self::assertInstanceOf(WithdrawnAssessment::class, $assessment);
    }

    /** @test */
    public function shouldCreateFromSuspended(): void
    {
        // BR 12 Suspended assessment may be withdrawn.

        // @todo should be moved to Builder
        $suspendedAssessment = new SuspendedAssessment(AssessmentBuilder::new()->build(), new LockReason('very avg reason'));

        $lockReason = new LockReason('very avg reason');
        $assessment = new WithdrawnAssessment($suspendedAssessment, $lockReason);

        self::assertInstanceOf(WithdrawnAssessment::class, $assessment);
        self::assertSame($lockReason, $assessment->lockReason);
    }

}
