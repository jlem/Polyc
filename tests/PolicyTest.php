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

    public function testPolicyCachesErrorAfterChecking()
    {
        $policy = new DeletePostPolicy();
        $policy->check(null);

        $this->assertSame($policy->getError(), $policy::INVALID_POST);
    }

    public function testPolicyReturnsResponseIfResponderIsSetAndPolicyFails()
    {
        $policy = new DeletePostPolicy();
        $response = $policy->withResponder(new DeletePostPolicyResponse())
                           ->check(null);

        $this->assertEquals('this is a failure response', $response);
    }

    public function testPolicyClearsResponderForSubsequentChecksIfPolicyFails()
    {
        $policy = new DeletePostPolicy();

        $policy->withResponder(new DeletePostPolicyResponse())->check(null);
        $result = $policy->check(null);

        $this->assertFalse($result);
    }

    public function testPolicyClearsResponderForSubsequentChecksIfPolicyPasses()
    {
        $policy = new DeletePostPolicy();

        $policy->withResponder(new DeletePostPolicyResponse())->check('its a post!');
        $result = $policy->check('its a post!');

        $this->assertTrue($result);
    }

    public function testPolicyReturnsNullIfResponderIsSetAndPolicyPasses()
    {
        $policy = new DeletePostPolicy();
        $response = $policy->withResponder(new DeletePostPolicyResponse())
                           ->check('its a post!');

        $this->assertNull($response);
    }
}
