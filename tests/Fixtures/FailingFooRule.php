<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Rule\Rule;
use Jlem\Polyc\Rule\Testable;

class FailingFooRule implements Testable
{
    use Rule;

    protected function evaluate()
    {
        return false;
    }
}