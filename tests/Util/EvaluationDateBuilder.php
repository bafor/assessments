<?php
declare(strict_types=1);

namespace Tests\Util;

use System\EvaluationDate;

class EvaluationDateBuilder
{

    private function __construct(
        private \DateTimeImmutable $evaluationDate = new \DateTimeImmutable('now')
    )
    {
    }

    public static function new(): self
    {
        return new self();
    }

    public function now(): self
    {
        $this->evaluationDate = new \DateTimeImmutable('now');

        return $this;
    }

    public function daysAgo(int $daysAgo): self
    {
        $this->evaluationDate = new \DateTimeImmutable("-{$daysAgo} days");

        return $this;
    }

    public function build(): EvaluationDate
    {
        return new EvaluationDate($this->evaluationDate);
    }
}