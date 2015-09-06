<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\PolicyConfiguration;
use Jlem\Polyc\PolicyContainer;
use Jlem\Polyc\Tests\Fixtures\DeletePostPolicy;
use Jlem\Polyc\Tests\Fixtures\SimplePolicyResolver;

class PolicyContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PolicyContainer
     */
    private $container;

    public function setUp()
    {
        $config = ['post.delete' => DeletePostPolicy::class];
        $config = new PolicyConfiguration($config);
        $resolver = new SimplePolicyResolver;
        $this->container = new PolicyContainer($config, $resolver);
    }

    public function testResolvesPolicyInstance()
    {
        $policy = $this->container->make('post.delete');
        $this->assertInstanceOf(Policy::class, $policy);
    }

    public function testResolvesPolicySingleton()
    {
        $policy1 = $this->container->make('post.delete');
        $policy2 = $this->container->make('post.delete');

        $this->assertSame($policy1, $policy2);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfPolicyCouldNotBeFound()
    {
        $this->container->make('nope');
    }

    public function testReturnsAllConfigs()
    {
        $expected = [
            'post.delete' => [
                'handler' => DeletePostPolicy::class
            ]
        ];

        $actual = $this->container->getConfiguration();

        $this->assertSame($expected, $actual);
    }

    public function testReturnsSpecificConfig()
    {
        $expected = [
            'handler' => DeletePostPolicy::class
        ];

        $actual = $this->container->getConfiguration('post.delete');

        $this->assertSame($expected, $actual);
    }
}
