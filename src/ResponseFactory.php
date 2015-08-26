<?php

namespace Jlem\Polyc;

interface ResponseFactory
{
    /**
     * @param string $policyKey
     * @param string $failingRuleClassName
     * @return mixed
     */
    public function make($policyKey, $failingRuleClassName);
}