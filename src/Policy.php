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
     * @var array
     */
    private $attributes;

    /**
     * Policy constructor.
     * @param string $key
     * @param array $rules
     * @param array $attributes
     */
    public function __construct($key, array $rules, array $attributes = [])
    {
        $this->key = $key;
        $this->rules = $rules;
        $this->attributes = $attributes;
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
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}