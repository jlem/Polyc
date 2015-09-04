<?php

namespace Jlem\Polyc\Rule;

trait Rule
{
    /**
     * Returns the test results of the evaluation
     * @param array $args
     * @return TestResults
     */
    public function test(array $args = [])
    {
        $evaluation = $this->evaluate(...$args);

        if (!is_bool($evaluation)) {
            throw new \InvalidArgumentException("Rule ".get_class($this)." did not return a boolean response. Check that it returns true or false");
        }

        return new TestResults(get_class($this), $evaluation);
    }
}