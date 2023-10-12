<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\SuspendedAssessment;
use System\Assessment\WithdrawnAssessment;
use System\LockReason;
use Tests\Util\AssessmentBuilder;

class SuspendedAssessmentTest extends TestCase
{
    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new SuspendedAssessment(AssessmentBuilder::new()->build(), new LockReason('very good reason'));

        self::assertInstanceOf(SuspendedAssessment::class, $assessment);
    }

    /** @test */
    public function itCouldBeWithdraw(): void
    {
        $lockReason = new LockReason('very good reason');
        $assessment = new SuspendedAssessment(AssessmentBuilder::new()->build(), $lockReason);

        $withdrawnAssessment = $assessment->withdraw();

        self::assertInstanceOf(WithdrawnAssessment::class, $withdrawnAssessment);
        self::assertSame($lockReason, $withdrawnAssessment->lockReason);
    }


}
