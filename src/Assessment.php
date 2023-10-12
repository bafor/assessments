<?php
declare(strict_types=1);

namespace System;

readonly class Assessment
{
    public const EXPIRATION_DAYS = 365;

    private \DateTimeImmutable $expirationDate;

    public function __construct(private Evaluation $evaluation)
    {
        $this->calculateExpirationDate($this->evaluation->evaluationDate);
    }

    public function isExpired(): bool
    {
        return $this->expirationDate < new \DateTimeImmutable('now');
    }

    private function calculateExpirationDate(EvaluationDate $evaluationDate): void
    {
        $this->expirationDate = $evaluationDate->evaluationDate
            ->modify("+" . self::EXPIRATION_DAYS . " days")
            ->setTime(23, 59, 59);
    }

    public function rating(): EvaluationResult // todo It separated from Evaluation result
    {
        return $this->evaluation->evaluationResult;
    }

}