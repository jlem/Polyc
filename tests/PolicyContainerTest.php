<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\PolicyContainer;
use Jlem\Polyc\Tests\Fixtures\TestContainer;
use Jlem\Polyc\Tests\Fixtures\TestRuleResolver;

class PolicyContainerTest extends \PHPUnit_Framework_TestCase
{
    protected $container;
    protected $config;

    public function setUp()
    {
        $resolver = new TestRuleResolver(new TestContainer());
        $this->container = new PolicyContainer($resolver);
        $this->config = require 'Fixtures/example_configuration.php';
        $this->container->set('foo.bar', $this->config);
    }

    public function testCreatesNewPolicyConfiguration()
    {
        $expected = $this->config;
        $actual = $this->container->getConfig('foo.bar');
        $this->assertSame($expected, $actual);
    }

    public function testCreatesMultiplePolicyConfigurations()
    {
        $this->container->set('baz.bar', []);
        $configs = $this->container->getConfig();
        $this->assertInternalType('array', $configs);
        $this->assertCount(2, $configs);
    }

    /**
     * @expectedException \Jlem\Polyc\PolicyNotFoundException
     */
    public function testInvalidKeyThrowsNotFoundException()
    {
        $this->container->getConfig('not.found');
    }

    public function testSubsequentCallsToMakeReturnTheSamePolicy()
    {
        $policy1 = $this->container->make('foo.bar');
        $policy2 = $this->container->make('foo.bar');
        $this->assertSame($policy1, $policy2);
    }
}
