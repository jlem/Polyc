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
     * @param array $rules
     * @param array $attributes
     */
    public function set($key, array $rules, array $attributes = [])
    {
        if (empty($rules)) {
            throw new \InvalidArgumentException("At least one rule is required to set a policy. Policy key: $key");
        }

        $this->config[$key]['rules'] = $rules;
        $this->config[$key]['attributes'] = $attributes;
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
     * @param string $rule
     * @return array
     */
    public function filterByRule($rule)
    {
        return array_filter($this->config, function ($config) use ($rule) {
            return in_array($rule, $config['rules']);
        });
    }

    /**
     * @param string $attributeKey
     * @param mixed $attributeValue
     * @return array
     */
    public function filterByAttributeValue($attributeKey, $attributeValue)
    {
        return array_filter($this->config, function ($config) use ($attributeKey, $attributeValue) {

            if (!array_key_exists($attributeKey, $config['attributes'])) {
                return false;
            }

            return $config['attributes'][$attributeKey] === $attributeValue;
        });
    }

    /**
     * @param string $attributeKey
     * @return array
     */
    public function filterByAttributeKey($attributeKey)
    {
        return array_filter($this->config, function ($config) use ($attributeKey) {
            return array_key_exists($attributeKey, $config['attributes']);
        });
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
    private function isCached($key)
    {
        return !array_key_exists($key, $this->cache);
    }
}
