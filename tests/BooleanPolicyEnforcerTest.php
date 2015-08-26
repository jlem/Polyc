<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Enforcers\BooleanPolicyEnforcer;
use Jlem\Polyc\Policy;

class BooleanPolicyEnforcerTest extends \PHPUnit_Framework_TestCase
{
    protected $enforcer;

    public function setUp()
    {
        $this->enforcer = new BooleanPolicyEnforcer;
    }

    public function testReturnsTrueIfAllRulesPass()
    {
        $policy = new Policy('foo.bar', [
            new Fixtures\FooRule,
            new Fixtures\BarRule,
            new Fixtures\BazRule
        ]);

        $actual = $this->enforcer->check($policy);

        $this->assertSame(true, $actual);
    }

    public function testReturnsFalseIfOneRuleFails()
    {
        $policy = new Policy('foo.bar', [
            new Fixtures\FailingFooRule,
            new Fixtures\BarRule,
            new Fixtures\BazRule
        ]);

        $actual = $this->enforcer->check($policy);

        $this->assertSame(false, $actual);
    }
}
