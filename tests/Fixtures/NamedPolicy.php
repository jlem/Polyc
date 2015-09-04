<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Policy;
use Jlem\Polyc\Rule\Testable;

final class NamedPolicy extends Policy
{
    protected $key = 'what';

    public function __construct(BarRule $barRule, BazRule $bazRule, RuleWithArgument $ruleWithArgument)
    {
        $this->addRule($barRule);
        $this->addRule($bazRule);
        $this->addRule($ruleWithArgument);
    }

    public function check($foo, $bar, $baz)
    {
        return $this->evaluate($foo, $bar, $baz);
    }

    public function response($foo, $bar, $baz)
    {
        return $this->getResponse($foo, $bar, $baz);
    }

    protected function addRule(Testable $rule)
    {
        $this->rules[] = $rule;
    }
}