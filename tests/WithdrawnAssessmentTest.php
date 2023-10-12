<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\LockReason;
use System\WithdrawnAssessment;
use Tests\Util\AssessmentBuilder;

class WithdrawnAssessmentTest extends TestCase
{
    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new WithdrawnAssessment(AssessmentBuilder::new()->build(), new LockReason('very avg reason'));

        self::assertInstanceOf(WithdrawnAssessment::class, $assessment);
    }

}
