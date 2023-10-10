<?php
declare(strict_types=1);

namespace System;

readonly class Evaluation
{
    public const EXPIRATION_DATE_IN_DAYS = 365;

    public function __construct(
        private \DateTimeImmutable $evaluationDate,
        private Supervisor         $supervisor
    )
    {
        if ($evaluationDate > new \DateTimeImmutable('now')) {
            throw new \InvalidArgumentException('Evaluation date cannot be in the future');
        }

    }

    public function isExpired(): bool
    {
        return $this->evaluationDate->diff(new \DateTimeImmutable())->days > 366;
    }
}