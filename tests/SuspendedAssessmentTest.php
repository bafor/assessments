<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\ExpiredAssessment;
use System\LockReason;
use System\SuspendedAssessment;
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
}
