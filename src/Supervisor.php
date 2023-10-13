<?php
declare(strict_types=1);

namespace System;

interface Supervisor
{
    public function hasAuthority(Standard $standard): bool;
}