<?php

namespace Jlem\Polyc\Rule;

interface RuleResolver
{
    /**
     * @param array $rules
     * @return array
     */
    public function resolve(array $rules);
}