<?php
declare(strict_types=1);

namespace System;

readonly class Evaluation
{
    public const EXPIRATION_DATE_IN_DAYS = 365;

    public function __construct(
        private EvaluationDate $evaluationDate,
        private Supervisor         $supervisor
    )
    {
    }

    public function isExpired(): bool
    {
        return $this->evaluationDate->evaluationDate->diff(new \DateTimeImmutable())->days > 366;
    }
}