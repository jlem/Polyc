<?php

namespace Jlem\Polyc;

abstract class RuleResolverAbstract
{
    /**
     * @param array $rules
     * @return array
     */
    public function resolve(array $rules)
    {
        $resolved = [];

        foreach ($rules as $rule) {
            $resolved[] = $this->resolveRule($rule);
        }

        return $resolved;
    }

    abstract protected function resolveRule($rule);
}