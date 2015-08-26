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
}
