<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\PolicyResolver;

class SimplePolicyResolver implements PolicyResolver
{
    public function resolve($class)
    {
        return new $class;
    }
}