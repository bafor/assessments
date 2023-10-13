<?php
declare(strict_types=1);

namespace System\Assessment;

use System\AssessmentCanNotBeEvaluatedUntil;
use System\Evaluation\Evaluation;
use System\Evaluation\EvaluationDate;
use System\Evaluation\EvaluationResult;
use System\Standard\Standard;
use System\Supervisor;
use System\SupervisorHasNoAuthorityInStandard;

readonly abstract class AbstractAssessment
{
    public function __construct(public Standard $standard, protected Evaluation $evaluation)
    {
    }

    public function rating(): EvaluationResult // todo separate it from Evaluation result
    {
        return $this->evaluation->evaluationResult;
    }

    final public function evaluate(Supervisor $supervisor, EvaluationResult $result): Assessment
    {
        if (!$supervisor->hasAuthority($this->standard)) {
            throw new SupervisorHasNoAuthorityInStandard();
        }

        if (!$this->evaluation->canBeRevaluate()) {
            throw new AssessmentCanNotBeEvaluatedUntil(); // here maybe some detail could be a good idea
        }

        return new Assessment($this->standard, new Evaluation(new EvaluationDate(), $supervisor, $result));
    }

}