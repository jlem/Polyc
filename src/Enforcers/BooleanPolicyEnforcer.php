<?php

namespace Jlem\Polyc\Enforcers;

use Jlem\Polyc\Policy;

class BooleanPolicyEnforcer implements PolicyEnforcer
{
    /**
     * Checks if policy request was approved
     * @param Policy $policy
     * @return bool
     */
    public function check(Policy $policy)
    {
        $policyResponse = $policy->ask();

        return $policyResponse->approved();
    }
}