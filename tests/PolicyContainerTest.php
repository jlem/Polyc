<?php

namespace Jlem\Polyc\Tests;

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
    }

    public function testCreatesNewPolicyConfiguration()
    {
        $this->container->set('foo.bar', $this->config['rules'], $this->config['attributes']);

        $expected = $this->config;
        $actual = $this->container->getConfig('foo.bar');
        $this->assertSame($expected, $actual);
    }

    public function testCreatesMultiplePolicyConfigurations()
    {
        $this->container->set('baz.bar', ['Jlem\Polyc\Tests\Fixtures\BarRule']);
        $this->container->set('bar.foo', ['Jlem\Polyc\Tests\Fixtures\BarRule']);

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
        $this->container->set('foo.bar', ['Jlem\Polyc\Tests\Fixtures\BarRule']);

        $policy1 = $this->container->make('foo.bar');
        $policy2 = $this->container->make('foo.bar');

        $this->assertSame($policy1, $policy2);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /At least one rule is required to set a policy. Policy key: (.*)/
     */
    public function testExceptionIsThrownIfRulesElementIsEmpty()
    {
        $this->container->set('blah.blah', []);
    }

    public function testPolicyConfigurationsCanBeFilteredByArbitraryRule()
    {
        $this->container->set('bar.foo', ['Jlem\Polyc\Tests\Fixtures\BarRule']);
        $this->container->set('baz.bar', ['Jlem\Polyc\Tests\Fixtures\FooRule']);
        $this->container->set('foo.baz', ['Jlem\Polyc\Tests\Fixtures\FooRule']);

        $policies = $this->container->filterByRule('Jlem\Polyc\Tests\Fixtures\FooRule');

        $this->assertInternalType('array', $policies);
        $this->assertCount(2, $policies);
    }

    public function testPolicyConfigurationCanBeFilteredByAttributeValue()
    {
        $this->container->set('bar.foo', ['Jlem\Polyc\Tests\Fixtures\BarRule'], ['acl' => true]);
        $this->container->set('bar.baz', ['Jlem\Polyc\Tests\Fixtures\BarRule'], ['acl' => false]);
        $this->container->set('baz.bar', ['Jlem\Polyc\Tests\Fixtures\BarRule'], ['something' => 'else']);

        $policies = $this->container->filterByAttributeValue('acl', true);

        $this->assertInternalType('array', $policies);
        $this->assertCount(1, $policies);
    }

    public function testPolicyConfigurationCanBeFilteredByAttributeKey()
    {
        $this->container->set('bar.foo', ['Jlem\Polyc\Tests\Fixtures\FooRule'], ['bar' => 'foo']);
        $this->container->set('bar.baz', ['Jlem\Polyc\Tests\Fixtures\BarRule'], ['foo' => 'bar']);
        $this->container->set('baz.bar', ['Jlem\Polyc\Tests\Fixtures\BarRule'], ['foo' => 'baz']);

        $policies = $this->container->filterByAttributeKey('foo');

        $this->assertInternalType('array', $policies);
        $this->assertCount(2, $policies);
    }
}
