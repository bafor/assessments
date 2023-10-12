<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\ExpiredAssessment;
use System\LockReason;
use System\SuspendedAssessment;
use System\WithdrawnAssessment;
use Tests\Util\AssessmentBuilder;
use Tests\Util\EvaluationBuilder;

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
