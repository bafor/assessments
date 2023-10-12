<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\AbstractAssessment;
use System\AssessmentFactory;
use Tests\Util\EvaluationBuilder;

class AssessmentFactoryTest extends TestCase
{

    /** @test */
    public function shouldCreateAssessment(): void
    {
        $evaluation = EvaluationBuilder::new()->build();

        $assessmentFactory = new AssessmentFactory();
        self::assertInstanceOf(AbstractAssessment::class, $assessmentFactory->create($evaluation));
    }

}
