<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Supervisor;

class SupervisorBuilder
{
    public static function new(): self
    {
        return new self();
    }

    public function build(): Supervisor
    {
        return new class() implements Supervisor {
        };
    }
}