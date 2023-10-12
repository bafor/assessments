<?php
declare(strict_types=1);

namespace System\Evaluation;

final readonly class EvaluationDate
{
    public function __construct(public \DateTimeImmutable $evaluationDate = new \DateTimeImmutable())
    {
        if ($evaluationDate > new \DateTimeImmutable('now')) {
            throw new \InvalidArgumentException('Evaluation date cannot be in the future');
        }
    }
}