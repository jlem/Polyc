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
        return array_map(function($rule) {
            return $this->resolveRule($rule);
        }, $rules);
    }

    abstract protected function resolveRule($rule);
}