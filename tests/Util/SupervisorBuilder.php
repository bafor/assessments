<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Standard\Standard;
use System\Supervisor;

class SupervisorBuilder
{

    public function __construct(
        private bool $hasAuthority = true
    )
    {
    }

    public static function new(): self
    {
        return new self();
    }

    public function build(): Supervisor
    {
        return new class($this->hasAuthority) implements Supervisor {

            public function __construct(private bool $hasAuthority)
            {
            }

            public function hasAuthority(Standard $standard): bool
            {
                return $this->hasAuthority;
            }
        };
    }
}