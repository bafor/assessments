<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use System\LockReason;
use System\ReasonIsNotDescriptive;

class LockReasonTest extends TestCase
{

    /** @test */
    public function shouldCreate(): void
    {
        $reason = 'very good reason';

        $lockReason = new LockReason($reason);

        self::assertEquals($reason, $lockReason->reason);
    }

    /** @test */
    public function shouldReasonBeDescriptive(): void
    {
        // BR16 Assessment lock should contain descriptive information about the operation performed.

        $reason = 'xx';

        $this->expectException(ReasonIsNotDescriptive::class);

        new LockReason($reason);
    }

}
