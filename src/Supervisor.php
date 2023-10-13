<?php
declare(strict_types=1);

namespace System;

use System\Standard\Standard;

interface Supervisor
{
    public function hasAuthority(Standard $standard): bool;
}