<?php
declare(strict_types=1);

namespace System;

final readonly class LockReason
{
    public function __construct(public string $reason)
    {
        if (strlen($reason) <= 3) {
            throw new ReasonIsNotDescriptive($reason);
        }
    }
}