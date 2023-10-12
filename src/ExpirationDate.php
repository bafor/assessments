<?php
declare(strict_types=1);

namespace System;

use System\Evaluation\EvaluationDate;

final readonly class ExpirationDate
{
    public const EXPIRATION_DAYS = 365;
    private \DateTimeImmutable $expirationDate;

    public function __construct(EvaluationDate $evaluationDate)
    {
        $this->expirationDate = $this->calculateExpirationDate($evaluationDate);
    }

    public function isExceeded(): bool
    {
        return $this->expirationDate < new \DateTimeImmutable('now');
    }

    private function calculateExpirationDate(EvaluationDate $evaluationDate): \DateTimeImmutable
    {
        return $evaluationDate->evaluationDate
            ->modify("+" . self::EXPIRATION_DAYS . " days")
            ->setTime(23, 59, 59);
    }

}