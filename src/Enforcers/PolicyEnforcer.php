<?php

namespace Jlem\Polyc\Enforcers;

use Jlem\Polyc\Policy;

interface PolicyEnforcer
{
    /**
     * @param string $key
     * @return mixed
     */
    public function check($key);
}