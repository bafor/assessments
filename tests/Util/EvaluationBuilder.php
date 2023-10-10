<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Evaluation;
use System\EvaluationDate;
use System\Supervisor;

class EvaluationBuilder
{
    private Supervisor $supervisor;

    private function __construct(
        private \DateTimeImmutable $evaluationDate = new \DateTimeImmutable()
    )
    {
        $this->supervisor = new class() implements Supervisor {
        };
    }

    public static function new(): self
    {
        return new self();
    }

    public function build(): Evaluation
    {
        return new Evaluation(
            evaluationDate: new EvaluationDate($this->evaluationDate),
            supervisor    : $this->supervisor
        );
    }
}