<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Policy;
use Jlem\Polyc\PolicyResponse;
use Jlem\Polyc\Tests\Fixtures\BarRule;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    public function testPolicyReturnsAPolicyResponseWhenAsked()
    {
        $policy = new Policy('foo.bar', [
            new BarRule()
        ]);

        $response = $policy->ask();

        $this->assertInstanceOf(PolicyResponse::class, $response);
    }
}
