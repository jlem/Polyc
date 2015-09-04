<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Rule\Rule;
use Jlem\Polyc\Rule\Testable;

class RuleWithArgument implements Testable
{
    use Rule;

    /**
     * Checks whether the rule evaluates to true or not
     * @param $string1
     * @param $string2
     * @param $string3
     * @return bool
     */
    protected function evaluate($string1, $string2, $string3)
    {
        return $string1 === 'Foo' && $string2 === 'Bar' && $string3 === 'Baz';
    }
}