<?php
declare(strict_types=1);

namespace System;

readonly class Assessment
{

    public function __construct(private Evaluation $evaluation)
    {
    }
}