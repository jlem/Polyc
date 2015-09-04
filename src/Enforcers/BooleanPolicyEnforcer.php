<?php

namespace Jlem\Polyc\Enforcers;

use Jlem\Polyc\Policy;
use Jlem\Polyc\PolicyContainer;

class BooleanPolicyEnforcer implements PolicyEnforcer
{
    /**
     * @var PolicyContainer
     */
    private $container;

    /**
     * BooleanPolicyEnforcer constructor.
     * @param PolicyContainer $container
     */
    public function __construct(PolicyContainer $container)
    {
        $this->container = $container;
    }

    /**
     * Checks if policy request was approved
     * @param string $key
     * @return bool
     */
    public function check($key)
    {
        $policy = $this->container->make($key);
        $policyResponse = $policy->getResponse();

        return $policyResponse->approved();
    }
}