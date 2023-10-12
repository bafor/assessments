<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment;
use System\EvaluationResult;
use System\ExpiredAssessment;
use Tests\Util\EvaluationBuilder;
use Tests\Util\EvaluationDateBuilder;

class ExpiredAssessmentTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new ExpiredAssessment(EvaluationBuilder::new()->build());

        self::assertInstanceOf(ExpiredAssessment::class, $assessment);
    }
}
