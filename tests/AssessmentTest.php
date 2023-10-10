<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Assessment;
use System\Evaluation;

class AssessmentTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $assessment = new Assessment(new Evaluation());

        self::assertInstanceOf(Assessment::class, $assessment);
    }
}
