<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Policy;
use Jlem\Polyc\Rule;
use Jlem\Polyc\Testable;

class FooRule implements Testable
{
    use Rule;

    protected function evaluate(Policy $policy)
    {
        return true;
    }
}