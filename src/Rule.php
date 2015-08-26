<?php

namespace Jlem\Polyc;

trait Rule
{
    /**
     * Checks whether the rule evaluates to true or not
     * @param Policy $policy
     * @return bool
     */
    abstract protected function evaluate(Policy $policy);

    /**
     * Returns the test results of the evaluation
     * @param Policy $policy
     * @return TestResults
     */
    public function test(Policy $policy)
    {
        $evaluation = $this->evaluate($policy);

        return new TestResults(get_class($this), $evaluation);
    }
}