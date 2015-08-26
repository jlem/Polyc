<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\PolicyConfiguration;

class RuleFilterTest extends \PHPUnit_Framework_TestCase
{
    protected $filter;

    public function setUp()
    {
        $configuration = new PolicyConfiguration(require 'Fixtures/full_configuration.php');
        $this->filter = new \Jlem\Polyc\Filters\RuleFilter($configuration->get());
    }

    public function testPolicyConfigurationsCanBeFilteredByArbitraryRule()
    {
        $policies = $this->filter->rule('Jlem\Polyc\Tests\Fixtures\FooRule');

        $this->assertInternalType('array', $policies);
        $this->assertCount(1, $policies);
    }
}
