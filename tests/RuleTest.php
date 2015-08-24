<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\TestResults;

class RuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * "Passing test" refers to the TestResult object - the test of the rule either passed or failed.
     * It does not refer to a unit test test.
     */
    public function testRuleReturnsPassingTestWhenEvaluatesToTrue()
    {
        $rule = new Fixtures\FooRule;
        $test = $rule->test(new Policy('whatever', []));

        $this->assertTrue($test->passed());
    }

    public function testRuleReturnsFailingTestWhenEvaluatesToFalse()
    {
        $rule = new Fixtures\FailingFooRule;
        $test = $rule->test(new Policy('whatever', []));

        $this->assertTrue($test->failed());
    }
}
