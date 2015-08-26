<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\PolicyConfiguration;
use Jlem\Polyc\PolicyContainer;
use Jlem\Polyc\Tests\Fixtures\TestContainer;
use Jlem\Polyc\Tests\Fixtures\TestRuleResolver;

class PolicyContainerTest extends \PHPUnit_Framework_TestCase
{
    protected $policyContainer;

    public function setUp()
    {
        $configuration = new PolicyConfiguration(require 'Fixtures/full_configuration.php');
        $resolver = new TestRuleResolver(new TestContainer());

        $this->policyContainer = new PolicyContainer($configuration, $resolver);
    }

    /**
     * @expectedException \Jlem\Polyc\PolicyNotFoundException
     */
    public function testInvalidKeyThrowsNotFoundException()
    {
        $this->policyContainer->getConfiguration('not.found');
    }

    public function testContainerMakesASingleton()
    {
        $policy1 = $this->policyContainer->make('foo.bar');
        $policy2 = $this->policyContainer->make('foo.bar');

        $this->assertSame($policy1, $policy2);
    }

    public function testPolicyConfigurationsCanBeFilteredByArbitraryRule()
    {
        $policies = $this->policyContainer->filterByRule('Jlem\Polyc\Tests\Fixtures\FooRule');

        $this->assertInternalType('array', $policies);
        $this->assertCount(1, $policies);
    }

    public function testPolicyConfigurationCanBeFilteredByAttributeValue()
    {
        $policies = $this->policyContainer->filterByAttributeValue('acl', true);

        $this->assertInternalType('array', $policies);
        $this->assertCount(1, $policies);
    }

    public function testPolicyConfigurationCanBeFilteredByAttributeKey()
    {
        $policies = $this->policyContainer->filterByAttributeKey('title');

        $this->assertInternalType('array', $policies);
        $this->assertCount(2, $policies);
    }
}
