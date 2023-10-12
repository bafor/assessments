<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\Assessment;
use System\Assessment\SuspendedAssessment;
use System\Assessment\WithdrawnAssessment;
use System\LockReason;
use Tests\Util\AssessmentBuilder;

class SuspendedAssessmentTest extends TestCase
{
    /** @test */
    public function shouldCreate(): void
    {
        $lockReason = new LockReason('very good reason');
        $assessment = new SuspendedAssessment(AssessmentBuilder::new()->build(), $lockReason);

        self::assertInstanceOf(SuspendedAssessment::class, $assessment);
        self::assertSame($lockReason, $assessment->lockReason);
    }

    /** @test */
    public function itCanBeWithdraw(): void
    {
        $lockReason = new LockReason('very good reason');
        $assessment = new SuspendedAssessment(AssessmentBuilder::new()->build(), $lockReason);

        $withdrawnAssessment = $assessment->withdraw();

        self::assertInstanceOf(WithdrawnAssessment::class, $withdrawnAssessment);
        self::assertSame($lockReason, $withdrawnAssessment->lockReason);
    }

    /** @test */
    public function itCanBeUnlocked(): void
    {
        // BR 11. Suspended assessment can be unlocked.

        $assessment = new SuspendedAssessment(AssessmentBuilder::new()->build(), new LockReason('very good reason'));

        $unlockedAssessment = $assessment->unlock();
        self::assertInstanceOf(Assessment::class, $unlockedAssessment);
    }

}
