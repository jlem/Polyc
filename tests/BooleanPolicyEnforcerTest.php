<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Enforcers\BooleanPolicyEnforcer;

class BooleanPolicyEnforcerTest extends \PHPUnit_Framework_TestCase
{
    protected $enforcer;

    public function setUp()
    {
        $container = require 'Fixtures/simple_container.php';
        $this->enforcer = new BooleanPolicyEnforcer($container);
    }

    public function testReturnsTrueIfAllRulesPass()
    {
        $actual = $this->enforcer->check('foo.bar');

        $this->assertSame(true, $actual);
    }

    public function testReturnsFalseIfOneRuleFails()
    {
        $actual = $this->enforcer->check('bar.baz');
        $this->assertSame(false, $actual);
    }
}
