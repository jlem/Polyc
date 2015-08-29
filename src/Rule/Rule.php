<?php

namespace Jlem\Polyc\Rule;

use Jlem\Polyc\Policy;
use Jlem\Polyc\Rule\TestResults;

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

        if (!is_bool($evaluation)) {
            throw new \InvalidArgumentException("Rule ".get_class($this)." did not return a boolean response. Check that it returns true or false");
        }

        return new TestResults(get_class($this), $evaluation);
    }
}