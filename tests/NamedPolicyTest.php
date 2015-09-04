<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Tests\Fixtures\BarRule;
use Jlem\Polyc\Tests\Fixtures\BazRule;
use Jlem\Polyc\Tests\Fixtures\NamedPolicy;
use Jlem\Polyc\Tests\Fixtures\RuleWithArgument;

class NamedPolicyTest extends \PHPUnit_Framework_TestCase
{
    public function testNamePolicyEvaluatesRules()
    {
        $policy = new NamedPolicy(
            new BarRule,
            new BazRule,
            new RuleWithArgument
        );

        $this->assertTrue($policy->check('Foo', 'Bar', 'Baz'));
    }
}
