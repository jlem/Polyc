<?php

namespace Jlem\Polyc;

interface PolicyResolver
{
    public function resolve($class);
}