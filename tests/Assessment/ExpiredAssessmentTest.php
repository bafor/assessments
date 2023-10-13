<?php
declare(strict_types=1);

namespace Tests\Assessment;

use PHPUnit\Framework\TestCase;
use System\Assessment\ExpiredAssessment;
use Tests\Util\EvaluationBuilder;
use Tests\Util\StandardBuilder;

class ExpiredAssessmentTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new ExpiredAssessment(StandardBuilder::new()->build(),EvaluationBuilder::new()->build());

        self::assertInstanceOf(ExpiredAssessment::class, $assessment);
    }
}
