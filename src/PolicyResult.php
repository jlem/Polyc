<?php

namespace Jlem\Polyc;

class PolicyResult
{
    /**
     * @var Policy
     */
    private $policy;

    /**
     * PolicyResult constructor.
     * @param Policy $policy
     */
    public function __construct(Policy $policy)
    {
        $this->policy = $policy;
    }

    public function passes()
    {
        return !$this->policy->hasError();
    }

    public function fails()
    {
        return !$this->passes();
    }

    public function exception()
    {
        if ($this->fails()) {
            $exception = $this->policy->getDefaultExceptionClass();
            throw new $exception($this->policy->getError());
        }
    }
}