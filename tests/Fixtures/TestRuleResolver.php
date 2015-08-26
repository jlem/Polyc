<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Rule\RuleResolver;
use Jlem\Polyc\Rule\RuleResolverAbstract;

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

    /**
     * @param $key
     * @return mixed
     */
    protected function resolveRule($key)
    {
        return $this->container->make($key);
    }
}