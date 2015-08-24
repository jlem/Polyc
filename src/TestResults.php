<?php

namespace Jlem\Polyc;

class TestResults
{
    private $evaluation;

    /**
     * TestResults constructor.
     * @param $evaluation
     */
    public function __construct($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function passed()
    {
        return $this->evaluation === true;
    }

    public function failed()
    {
        return !$this->passed();
    }
}