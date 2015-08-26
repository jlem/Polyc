<?php

namespace Jlem\Polyc;

class ResponsePolicyEnforcer
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