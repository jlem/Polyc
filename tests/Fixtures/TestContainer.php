<?php

namespace Jlem\Polyc\Tests\Fixtures;

class TestContainer
{
    public function make($class)
    {
        return new $class;
    }
}