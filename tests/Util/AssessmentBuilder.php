<?php
declare(strict_types=1);

namespace Tests\Util;

use System\Assessment;

class AssessmentBuilder
{
    public static function new(): self
    {
        return new self();
    }

    public function build(): Assessment
    {
        return new Assessment(EvaluationBuilder::new()->build());
    }
}