<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Tests\Fixtures\DeletePostPolicy;
use Jlem\Polyc\Tests\Fixtures\DeletePostPolicyResponse;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckingValidPolicyReturnsTrue()
    {
        $policy = new DeletePostPolicy();
        $result = $policy->check('its a post!');

        $this->assertTrue($result);
    }

    public function testCheckingInvalidPolicyReturnsFalse()
    {
        $policy = new DeletePostPolicy();
        $result = $policy->check(null);

        $this->assertFalse($result);
    }

    public function testPolicyCachesResultAfterChecking()
    {
        $policy = new DeletePostPolicy();
        $policy->check('its a post!');

        $this->assertTrue($policy->getResult());
    }

    public function testPolicyCachesErrorAfterChecking()
    {
        $policy = new DeletePostPolicy();
        $policy->check(null);

        $this->assertSame($policy->getError(), $policy::INVALID_POST);
    }

    public function testPolicyGetsResponse()
    {
        $policy = new DeletePostPolicy();
        $policy->check(null);
        $response = $policy->getResponse(new DeletePostPolicyResponse());

        $this->assertFalse($response);
    }

    /**
     * @expectedException \LogicException
     */
    public function testPolicyRequiresCheckingBeforeGettingResponse()
    {
        $policy = new DeletePostPolicy();
        $policy->getResponse(new DeletePostPolicyResponse());
    }
}
