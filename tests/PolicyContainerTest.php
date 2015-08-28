<?php

namespace Jlem\Polyc\Tests;

class PolicyContainerTest extends \PHPUnit_Framework_TestCase
{
    protected $policyContainer;

    public function setUp()
    {
        $this->policyContainer = require 'Fixtures/simple_container.php';
    }

    /**
     * @expectedException \Jlem\Polyc\PolicyNotFoundException
     */
    public function testInvalidKeyThrowsNotFoundException()
    {
        $this->policyContainer->getConfiguration('not.found');
    }

    public function testContainerMakesASingleton()
    {
        $policy1 = $this->policyContainer->make('foo.bar');
        $policy2 = $this->policyContainer->make('foo.bar');

        $this->assertSame($policy1, $policy2);
    }
}
