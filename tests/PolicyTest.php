<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\Tests\Fixtures\BarRule;
use Jlem\Polyc\Tests\Fixtures\BazRule;
use Jlem\Polyc\Tests\Fixtures\FooRule;
use Jlem\Polyc\Tests\Fixtures\NonBooleanFooRule;
use Jlem\Polyc\Tests\Fixtures\RuleWithArgument;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    public function testPolicyEvaluatesRules()
    {
        $policy = new Policy('foo.bar', [
            new FooRule,
            new BazRule,
            new BarRule
        ]);

        $this->assertTrue($policy->evaluate('some', 'thing'));
    }

    public function testPolicyResponseIsASingleton()
    {
        $policy = new Policy('foo.bar', [
            new FooRule,
            new BazRule,
            new BarRule
        ]);

        $response1 = $policy->getResponse();
        $response2 = $policy->getResponse();

        $this->assertSame($response1, $response2);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionShouldBeThrownIfARuleDoesNotEvaluateABoolean()
    {
        $policy = new Policy('foo.bar', [
            new NonBooleanFooRule,
        ]);

        $policy->getResponse();
    }

    public function testPolicyCanAcceptArrayOfArguments()
    {
        $policy = new Policy('foo.bar', [
            new RuleWithArgument
        ]);

        $response = $policy->getResponse(['Foo', 'Bar', 'Baz']);

        $this->assertTrue($response->approved());
    }
}
