<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment\AbstractAssessment;
use System\Assessment\ExpiredAssessment;
use System\AssessmentFactory;
use Tests\Util\EvaluationBuilder;
use Tests\Util\EvaluationDateBuilder;

class AssessmentFactoryTest extends TestCase
{
    private AssessmentFactory $assessmentFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assessmentFactory = new AssessmentFactory();
    }

    /** @test */
    public function shouldCreateAssessment(): void
    {
        $evaluation = EvaluationBuilder::new()->build();

        self::assertInstanceOf(AbstractAssessment::class, $this->assessmentFactory->make($evaluation));
    }

    /** @test */
    public function shouldReturnExpiredAssessmentBasedOnEvaluationDate(): void
    {

        $evaluationDate = EvaluationDateBuilder::new()->daysAgo(1000)->build();
        $evaluation     = EvaluationBuilder::new()->withEvaluationDate($evaluationDate)->build();

        self::assertInstanceOf(ExpiredAssessment::class, $this->assessmentFactory->make($evaluation));
    }

}
