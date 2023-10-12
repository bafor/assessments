<?php
declare(strict_types=1);

namespace System;

class ReasonIsNotDescriptive extends \InvalidArgumentException
{
    public function __construct(public string $reason)
    {
        parent::__construct("Lock reason must be more descriptive.");
    }
}