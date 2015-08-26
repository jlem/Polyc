<?php

namespace Jlem\Polyc;

use InvalidArgumentException;

class PolicyConfiguration
{
    /**
     * @var array;
     */
    private $config;

    /**
     * PolicyConfiguration constructor.
     * @param mixed $config
     * @throws InvalidArgumentException
     */
    public function __construct(array $config)
    {
        $this->validateConfig($config);
        $this->setPolicies($config);
    }

    public function get()
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @throws InvalidArgumentException
     */
    private function validateConfig(array $config)
    {
        if (empty($config)) {
            throw new InvalidArgumentException('Policy configuration cannot be empty');
        }
    }

    /**
     * @param array $config
     */
    private function setPolicies(array $config)
    {
        foreach ($config as $policyKey => $policyDefinition) {
            $this->setPolicy($policyKey, $policyDefinition);
        }
    }

    /**
     * @param $policyKey
     * @param $policyDefinition
     */
    private function setPolicy($policyKey, $policyDefinition)
    {
        $this->validateRules($policyDefinition, $policyKey);

        if (!array_key_exists('attributes', $policyDefinition)) {
            $policyDefinition['attributes'] = [];
        }

        $this->config[$policyKey] = $policyDefinition;
    }

    /**
     * @param $policyDefinition
     * @param $policyKey
     */
    private function validateRules($policyDefinition, $policyKey)
    {
        if (
            !isset($policyDefinition['rules'])
            || !array_key_exists('rules', $policyDefinition)
            || empty($policyDefinition['rules'])
        ) {
            throw new InvalidArgumentException("Policy $policyKey does not have any configured rules");
        }
    }
}