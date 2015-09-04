<?php

namespace Jlem\Polyc\Enforcers;

use Jlem\Polyc\Policy;
use Jlem\Polyc\PolicyContainer;
use Jlem\Polyc\ResponseFactory;

class ResponsePolicyEnforcer implements PolicyEnforcer
{
    /**
     * @var PolicyContainer
     */
    private $container;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * ResponsePolicyEnforcer constructor.
     * @param PolicyContainer $container
     * @param ResponseFactory $responseFactory
     */
    public function __construct(PolicyContainer $container, ResponseFactory $responseFactory)
    {
        $this->container = $container;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Checks if policy request was denied, and returns pre-configured response
     * @param string $key
     * @return mixed|null
     */
    public function check($key)
    {
        $policy = $this->container->make($key);
        $policyResponse = $policy->getResponse();
        $failingRule = $policyResponse->denied();

        if ($failingRule === false) {
            return null;
        }

        return $this->responseFactory->make($key, $failingRule);
    }
}