<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\RuleResolver;
use Jlem\Polyc\RuleResolverAbstract;

class TestRuleResolver extends RuleResolverAbstract implements RuleResolver
{
    /**
     * @var TestContainer
     */
    private $container;

    /**
     * TestRuleResolver constructor.
     * @param TestContainer $container
     */
    public function __construct(TestContainer $container)
    {
        $this->container = $container;
    }

    protected function resolveRule($class)
    {
        return $this->container->make($class);
    }
}