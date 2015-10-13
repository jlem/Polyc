<?php

namespace Jlem\Polyc;

use InvalidArgumentException;

class PolicyContainer
{
    /**
     * @var string
     */
    protected $exceptionClass;
    /**
     * @var PolicyConfiguration
     */
    private $configuration;
    /**
     * @var array
     */
    private $cache = [];
    /**
     * @var PolicyResolver
     */
    private $policyResolver;

    public function __construct(PolicyConfiguration $configuration, PolicyResolver $policyResolver)
    {
        $this->policyResolver = $policyResolver;
        $this->configuration = $configuration->get();
    }

    public function setExceptionClass($exceptionClass)
    {
        $this->exceptionClass = $exceptionClass;
    }

    /**
     * Creates a new policy from the configuration registry
     * @param string $key
     * @return Policy
     */
    public function make($key)
    {
        $config = $this->getSingleConfig($key);

        if (!$this->isCached($key)) {
            /** @var Policy $policy */
            $policy = $this->policyResolver->resolve($config['handler']);
            $policy->setKey($key);
            $policy->setDefaultExceptionClass($this->exceptionClass);
            $this->cache[$key] = $policy;
        }

        return $this->cache[$key];
    }

    /**
     * Gets all of the policy configuration data from the given key
     * If no key is given, all of the policy configurations are returned
     * @param null|string $key
     * @return array
     * @throws PolicyNotFoundException
     */
    public function getConfiguration($key = null)
    {
        if (is_null($key)) {
            return $this->configuration;
        }

        return $this->getSingleConfig($key);
    }

    /**
     * @param string $key
     * @return array
     * @throws PolicyNotFoundException
     */
    private function getSingleConfig($key)
    {
        if (!$this->configExists($key)) {
            throw new InvalidArgumentException("The policy: $key, has not been configured");
        }

        return $this->configuration[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    private function configExists($key)
    {
        return array_key_exists($key, $this->configuration);
    }

    /**
     * @param $key
     * @return bool
     */
    private function isCached($key)
    {
        return array_key_exists($key, $this->cache);
    }
}
