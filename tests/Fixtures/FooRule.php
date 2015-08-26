<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Policy;
use Jlem\Polyc\Rule\Rule;
use Jlem\Polyc\Rule\Testable;

class FooRule implements Testable
{
    use Rule;

    protected function evaluate(Policy $policy)
    {
        return true;
    }
}