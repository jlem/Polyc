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
            /** @var Testable $rule */
            return $rule->test($this);
        }, $this->getRules());

        return new PolicyResponse($results);
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
}