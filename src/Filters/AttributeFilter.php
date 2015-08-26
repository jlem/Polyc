<?php

namespace Jlem\Polyc\Filters;

class AttributeFilter
{
    /**
     * @var array
     */
    private $configuredPolicies;

    /**
     * AttributeFilter constructor.
     * @param array $configuredPolicies
     */
    public function __construct(array $configuredPolicies)
    {
        $this->configuredPolicies = $configuredPolicies;
    }

    /**
     * @param string $attributeKey
     * @return array
     */
    public function key($attributeKey)
    {
        return array_filter($this->configuredPolicies, function ($policy) use ($attributeKey) {
            return array_key_exists($attributeKey, $policy['attributes']);
        });
    }

    /**
     * @param string $attributeKey
     * @param mixed $attributeValue
     * @return array
     */
    public function value($attributeKey, $attributeValue)
    {
        return array_filter($this->configuredPolicies, function ($policy) use ($attributeKey, $attributeValue) {
            if (!array_key_exists($attributeKey, $policy['attributes'])) {
                return false;
            }

            return $policy['attributes'][$attributeKey] === $attributeValue;
        });
    }
}