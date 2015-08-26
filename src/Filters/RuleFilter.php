<?php

namespace Jlem\Polyc\Filters;

class RuleFilter
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
     * @param string $rule
     * @return array
     */
    public function rule($rule)
    {
        return array_filter($this->configuredPolicies, function ($policy) use ($rule) {
            return in_array($rule, $policy['rules']);
        });
    }
}