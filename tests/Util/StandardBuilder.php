<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Standard\DummyStandard;
use System\Standard\Standard;

class StandardBuilder
{
    public static function new(): self
    {
        return new self();
    }

    public function build(): Standard
    {
        return new DummyStandard();
    }
}