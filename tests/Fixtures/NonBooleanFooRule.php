<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Rule\Rule;
use Jlem\Polyc\Rule\Testable;

class NonBooleanFooRule implements Testable
{
    use Rule;

    protected function evaluate()
    {
        return null;
    }
}