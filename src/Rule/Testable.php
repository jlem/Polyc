<?php

namespace Jlem\Polyc\Rule;

use Jlem\Polyc\Policy;

interface Testable
{
    public function test(Policy $policy);
}