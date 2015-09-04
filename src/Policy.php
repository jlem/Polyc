<?php

namespace Jlem\Polyc;

use Jlem\Polyc\Rule\Testable;

class Policy
{
    /**
     * @var string
     */
    protected $key;
    /**
     * @var array
     */
    protected $rules;

    /**
     * @var PolicyResponse
     */
    private $response;

    /**
     * @var array
     */
    private $args;

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
     * @param $args
     * @return bool
     */
    public function evaluate(...$args)
    {
        return $this->getResponse($args)->approved();
    }

    /**
     * @param $args
     * @return PolicyResponse
     */
    public function getResponse(array $args = [])
    {
        $this->args = $args;

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
            return $rule->test($this->args);
        }, $this->getRules());

        return $results;
    }
}