<?php

namespace Jlem\Polyc;

class PolicyResponse
{
    /**
     * @var array
     */
    private $testResults;

    /**
     * PolicyResponse constructor.
     * @param array $testResults
     */
    public function __construct(array $testResults)
    {
        $this->testResults = $testResults;
    }

    public function approved()
    {
        foreach ($this->testResults as $test) {
            if ($test->failed()) {
                return false;
            }
        }

        return true;
    }

    public function denied()
    {
        return !$this->approved();
    }
}