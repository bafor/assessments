<?php
declare(strict_types=1);

namespace Tests;

use System\DummyStandard;
use PHPUnit\Framework\TestCase;
use System\Standard;

class DummyStandardTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $standard = new DummyStandard();

        self::assertInstanceOf(Standard::class, $standard);
    }
}
