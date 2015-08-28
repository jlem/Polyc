<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\ResponseFactory;

class TestResponseFactory implements ResponseFactory
{
    public function make($policyKey, $failingRuleClassName)
    {
        switch($policyKey) {
            case 'bar.baz':
                switch($failingRuleClassName) {
                    case 'Jlem\Polyc\Tests\Fixtures\FailingFooRule':
                        return "The Failing Foo Rule Failed!";
                }
        }
    }
}