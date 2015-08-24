<?php

namespace Jlem\Polyc;

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
        $results = array_map(function($rule) {
           return $rule->test($this);
        }, $this->getRules());

        return new PolicyResponse($results);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}