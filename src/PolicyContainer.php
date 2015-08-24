<?php

namespace Jlem\Polyc;

class PolicyContainer
{
    protected $config = [];
    protected $cache = [];

    /**
     * @var RuleResolver
     */
    private $ruleResolver;

    public function __construct(RuleResolver $ruleResolver)
    {
        $this->ruleResolver = $ruleResolver;
    }

    /**
     * Attaches a new policy configuration to the registry
     *
     * @param string $key
     * @param array $policyConfiguration
     * @return void
     */
    public function set($key, array $policyConfiguration)
    {
        $this->config[$key] = $policyConfiguration;
    }

    /**
     * Creates a new policy from the configuration registry
     *
     * @param string $key
     * @return Policy
     */
    public function make($key)
    {
        $config = $this->getSingleConfig($key);

        $rules = $this->ruleResolver->resolve($config['rules']);

        if ($this->isCached($key)) {
            $this->cache[$key] = new Policy($key, $rules);
        }

        return $this->cache[$key];
    }

    /**
     * Gets all of the policy configuration data from the given key
     * If no key is given, all of the policy configurations are returned
     *
     * @param null|string $key
     * @return array
     * @throws PolicyNotFoundException
     */
    public function getConfig($key = null)
    {
        if (is_null($key)) {
            return $this->config;
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
        if ($this->configExists($key)) {
            return $this->config[$key];
        }

        throw new PolicyNotFoundException("The policy: $key, has not been configured");
    }

    /**
     * @param string $key
     * @return bool
     */
    private function configExists($key)
    {
        return array_key_exists($key, $this->config);
    }

    /**
     * @param $key
     * @return bool
     */
    public function isCached($key)
    {
        return !array_key_exists($key, $this->cache);
    }
}