<?php

namespace Jlem\Polyc\Rule;

class TestResults
{
    private $evaluation;
    private $testedClassName;

    /**
     * TestResults constructor.
     * @param string $testedClassName
     * @param bool $evaluation
     */
    public function __construct($testedClassName, $evaluation)
    {
        $this->testedClassName = $testedClassName;
        $this->evaluation = $evaluation;
    }

    /**
     * @return bool
     */
    public function passed()
    {
        return $this->evaluation === true;
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return !$this->passed();
    }

    /**
     * @return string
     */
    public function getTestedClassName()
    {
        return $this->testedClassName;
    }
}