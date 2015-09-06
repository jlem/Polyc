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
        $policyDefinition = $this->convertSimplePolicyToArrayWithHandler($policyDefinition);
        $this->validatePolicy($policyKey, $policyDefinition);
        $this->config[$policyKey] = $policyDefinition;
    }

    /**
     * @param $policyKey
     * @param $policyDefinition
     */
    private function validatePolicy($policyKey, $policyDefinition)
    {
        if (is_array($policyDefinition) && !array_key_exists('handler', $policyDefinition)) {
            throw new InvalidArgumentException("The configuration for $policyKey is missing a handler");
        }
    }

    /**
     * @param $policyDefinition
     * @return array
     */
    private function convertSimplePolicyToArrayWithHandler($policyDefinition)
    {
        return !is_array($policyDefinition) ? ['handler' => $policyDefinition] : $policyDefinition;
    }
}