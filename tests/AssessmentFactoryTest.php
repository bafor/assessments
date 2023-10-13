<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment\AbstractAssessment;
use System\Assessment\Assessment;
use System\Assessment\ExpiredAssessment;
use System\AssessmentFactory;
use System\Standard;
use Tests\Util\EvaluationBuilder;
use Tests\Util\EvaluationDateBuilder;
use Tests\Util\StandardBuilder;

class AssessmentFactoryTest extends TestCase
{
    private AssessmentFactory $assessmentFactory;
    private Standard  $standard;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assessmentFactory = new AssessmentFactory();
        $this->standard = StandardBuilder::new()->build();
    }

    /** @test */
    public function shouldCreateAssessment(): void
    {
        $evaluation = EvaluationBuilder::new()->build();

        $assessment = $this->assessmentFactory->make($this->standard, $evaluation);
        self::assertInstanceOf(Assessment::class, $assessment);
        self::assertSame($this->standard, $assessment->standard);
    }

    /** @test */
    public function shouldReturnExpiredAssessmentBasedOnEvaluationDate(): void
    {

        $evaluationDate = EvaluationDateBuilder::new()->daysAgo(1000)->build();
        $evaluation     = EvaluationBuilder::new()->withEvaluationDate($evaluationDate)->build();

        $assessment = $this->assessmentFactory->make($this->standard, $evaluation);
        self::assertInstanceOf(ExpiredAssessment::class, $assessment);
        self::assertSame($this->standard, $assessment->standard);
    }

}
