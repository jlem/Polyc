<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\ResponsePolicyEnforcer;

class ResponsePolicyEnforcerTest extends \PHPUnit_Framework_TestCase
{
    protected $enforcer;

    public function setUp()
    {
        $responseFactory = new Fixtures\TestResponseFactory;
        $this->enforcer = new ResponsePolicyEnforcer($responseFactory);
    }

    public function testReturnsNullIfAllRulesPass()
    {
        $policy = new Policy('foo.bar', [
            new Fixtures\FooRule,
            new Fixtures\BarRule,
            new Fixtures\BazRule
        ]);

        $actual = $this->enforcer->check($policy);

        $this->assertNull($actual);
    }

    public function testReturnsTheConfiguredResponseIfOneRuleFails()
    {
        $policy = new Policy('foo.bar', [
            new Fixtures\FailingFooRule,
            new Fixtures\BarRule,
            new Fixtures\BazRule
        ]);

        $expected = "The Failing Foo Rule Failed!";
        $actual = $this->enforcer->check($policy);

        $this->assertSame($expected, $actual);
    }
}
