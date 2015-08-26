<?php

namespace Jlem\Polyc\Enforcers;

use Jlem\Polyc\Policy;
use Jlem\Polyc\ResponseFactory;

class ResponsePolicyEnforcer implements PolicyEnforcer
{
    private $responseFactory;

    /**
     * ResponsePolicyEnforcer constructor.
     * @param $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Checks if policy request was denied, and returns pre-configured response
     * @param Policy $policy
     * @return mixed|null
     */
    public function check(Policy $policy)
    {
        $key = $policy->getKey();
        $policyResponse = $policy->ask();
        $failingRule = $policyResponse->denied();

        if ($failingRule === false) {
            return null;
        }

        return $this->responseFactory->make($key, $failingRule);
    }
}