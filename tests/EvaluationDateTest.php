<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\EvaluationDate;

class EvaluationDateTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $date = new \DateTimeImmutable();
        $evaluationDate  = new EvaluationDate($date);

        self::assertInstanceOf(EvaluationDate::class, $evaluationDate);
        self::assertSame($date, $evaluationDate->evaluationDate);
    }

    /** @test */
    public function mustNotTakePlaceInTheFuture(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new EvaluationDate(evaluationDate: new \DateTimeImmutable('tomorrow'));
    }

}
