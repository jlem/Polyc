<?php

namespace Jlem\Polyc;

class BooleanPolicyEnforcer
{
    public function check(Policy $policy)
    {
        $policyResponse = $policy->ask();

        return $policyResponse->approved();
    }
}