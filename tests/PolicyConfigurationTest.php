<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\PolicyConfiguration;


class PolicyConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfConfigurationIsEmpty()
    {
        new PolicyConfiguration([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfPolicyHasMissingRules()
    {
        $config = [
            'foo' => ['whatever']
        ];

        new PolicyConfiguration($config);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfPolicyHasEmptyRules()
    {
        $config = [
            'foo' => [
                'rules' => []
            ]
        ];

        new PolicyConfiguration($config);
    }

    public function testPoliciesAreProperlyConfigured()
    {
        $definedConfiguration = require 'Fixtures/full_configuration.php';
        $expectedConfiguration = require 'Fixtures/expected_configuration.php';

        $configuration = new PolicyConfiguration($definedConfiguration);

        $actualConfiguration = $configuration->get();

        $this->assertSame($expectedConfiguration, $actualConfiguration);
    }
}
