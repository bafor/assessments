<?php
declare(strict_types=1);

namespace Tests\Standard;

use PHPUnit\Framework\TestCase;
use System\Standard\DummyStandard;
use System\Standard\Standard;

class DummyStandardTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $standard = new DummyStandard();

        self::assertInstanceOf(Standard::class, $standard);
    }
}
