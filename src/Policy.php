<?php

namespace Jlem\Polyc;

use Jlem\Polyc\Rule\Testable;

class Policy
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var array
     */
    private $rules;

    /**
     * @var PolicyResponse
     */
    private $response;

    /**
     * Policy constructor.
     * @param string $key
     * @param array $rules
     */
    public function __construct($key, array $rules)
    {
        $this->key = $key;
        $this->rules = $rules;
    }

    /**
     * @return PolicyResponse
     */
    public function ask()
    {
        if ($this->responseIsCached()) {
            return $this->response;
        }

        return $this->makeNewResponse();
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @return bool
     */
    private function responseIsCached()
    {
        return !is_null($this->response);
    }

    /**
     * @return PolicyResponse
     */
    private function makeNewResponse()
    {
        return $this->response = new PolicyResponse($this->testRules());
    }

    /**
     * @return array
     */
    private function testRules()
    {
        $results = array_map(function ($rule) {
            /** @var Testable $rule */
            return $rule->test($this);
        }, $this->getRules());

        return $results;
    }
}