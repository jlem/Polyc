<?php

namespace Jlem\Polyc\Enforcers;

use Jlem\Polyc\Policy;

interface PolicyEnforcer
{
    /**
     * @param Policy $policy
     * @return mixed
     */
    public function check(Policy $policy);
}