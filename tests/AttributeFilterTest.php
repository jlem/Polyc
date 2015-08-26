<?php

namespace Jlem\Polyc\Tests;

use Jlem\Polyc\Filters\AttributeFilter;
use Jlem\Polyc\PolicyConfiguration;

class AttributeFilterTest extends \PHPUnit_Framework_TestCase
{
    protected $filter;

    public function setUp()
    {
        $configuration = new PolicyConfiguration(require 'Fixtures/full_configuration.php');
        $this->filter = new AttributeFilter($configuration->get());
    }

    public function testPolicyConfigurationCanBeFilteredByAttributeValue()
    {
        $policies = $this->filter->value('acl', true);

        $this->assertInternalType('array', $policies);
        $this->assertCount(1, $policies);
    }

    public function testPolicyConfigurationCanBeFilteredByAttributeKey()
    {
        $policies = $this->filter->key('title');

        $this->assertInternalType('array', $policies);
        $this->assertCount(2, $policies);
    }
}
