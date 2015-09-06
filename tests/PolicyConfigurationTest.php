<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\PolicyConfiguration;
use Jlem\Polyc\Tests\Fixtures\DeletePostPolicy;

class PolicyConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfConfigIsEmpty()
    {
        new PolicyConfiguration([]);
    }

    public function testSimpleKeyValueConfigurationGetsNormalized()
    {
        $config = new PolicyConfiguration(['post.delete' => DeletePostPolicy::class]);
        $actual = $config->get();

        $expected = [
            'post.delete' => [
                'handler' => DeletePostPolicy::class,
            ]
        ];

        $this->assertSame($actual, $expected);
    }

    public function testDetailedConfiguration()
    {
        $configuration = [
            'post.delete' => [
                'handler' => DeletePostPolicy::class,
                'some' => 'attribute'
            ]
        ];

        $config = new PolicyConfiguration($configuration);
        $config = $config->get();

        $this->assertSame($config, $configuration);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDetailedConfigurationRequiresHandlerAttribute()
    {
        $configuration = [
            'post.delete' => [
                'some' => 'attribute'
            ]
        ];

        new PolicyConfiguration($configuration);
    }
}
