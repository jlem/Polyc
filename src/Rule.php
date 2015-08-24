<?php

namespace Jlem\Polyc;

trait Rule
{
    abstract protected function evaluate(Policy $policy);

    public function test(Policy $policy)
    {
        $evaluation = $this->evaluate($policy);

        return new TestResults($evaluation);
    }
}