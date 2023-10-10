<?php
declare(strict_types=1);

namespace System;

readonly class Evaluation
{
    public function __construct(
        private \DateTimeImmutable $evaluationDate,
        private Supervisor $supervisor
    )
    {
    }

    public function isExpired(): bool
    {
        return false;
    }
}