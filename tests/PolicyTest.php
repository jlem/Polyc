<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\Tests\Fixtures\BarRule;
use Jlem\Polyc\Tests\Fixtures\BazRule;
use Jlem\Polyc\Tests\Fixtures\FooRule;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    public function testPolicyResponseIsASingleton()
    {
        $policy = new Policy('foo.bar', [
            new FooRule,
            new BazRule,
            new BarRule
        ]);

        $response1 = $policy->ask();
        $response2 = $policy->ask();

        $this->assertSame($response1, $response2);
    }
}
