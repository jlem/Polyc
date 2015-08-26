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

    /**
     * Checks whether or not the policy request was approved
     * @return bool
     */
    public function approved()
    {
        foreach ($this->testResults as $test) {
            /** @var TestResults $test */
            if ($test->failed()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns the class name of the first failed rule it encounters
     * @return false|string
     */
    public function denied()
    {
        foreach ($this->testResults as $test) {
            /** @var TestResults $test */
            if ($test->failed()) {
                return $test->getTestedClassName();
            }
        }

        return false;
    }
}