<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\PolicyResponse;
use Jlem\Polyc\TestResults;

class PolicyResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testPolicyResponseApprovesRequestIfAllTestsPass()
    {
        $response = new PolicyResponse([
            new TestResults(true),
            new TestResults(true),
            new TestResults(true)
        ]);

        $this->assertTrue($response->approved());
    }

    public function testPolicyResponseApprovesRequestIfAtLeastOneTestFails()
    {
        $response = new PolicyResponse([
            new TestResults(true),
            new TestResults(true),
            new TestResults(false)
        ]);

        $this->assertTrue($response->denied());
    }
}
