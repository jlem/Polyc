<?php

namespace Jlem\Polyc;

interface RuleResolver
{
    /**
     * @param array $rules
     * @return array
     */
    public function resolve(array $rules);
}