<?php

namespace Jlem\Polyc;

class Policy
{
    private $key;
    /**
     * @var array
     */
    private $rules;

    /**
     * Policy constructor.
     * @param $key
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
        $results = [];

        foreach ($this->getRules() as $rule) {
            $results[] = $rule->test($this);
        }

        return new PolicyResponse($results);
    }

    public function getRules()
    {
        return $this->rules;
    }
}