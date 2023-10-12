<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\ExpiredAssessment;
use Tests\Util\EvaluationBuilder;

class ExpiredAssessmentTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new ExpiredAssessment(EvaluationBuilder::new()->build());

        self::assertInstanceOf(ExpiredAssessment::class, $assessment);
    }
}
