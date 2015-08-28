<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Enforcers\ResponsePolicyEnforcer;

class ResponsePolicyEnforcerTest extends \PHPUnit_Framework_TestCase
{
    protected $enforcer;

    public function setUp()
    {
        $container = require 'Fixtures/simple_container.php';

        $responseFactory = new Fixtures\TestResponseFactory;
        $this->enforcer = new ResponsePolicyEnforcer($container, $responseFactory);
    }

    public function testReturnsNullIfAllRulesPass()
    {
        $actual = $this->enforcer->check('foo.bar');
        $this->assertNull($actual);
    }

    public function testReturnsTheConfiguredResponseIfOneRuleFails()
    {
        $expected = "The Failing Foo Rule Failed!";
        $actual = $this->enforcer->check('bar.baz');

        $this->assertSame($expected, $actual);
    }
}
