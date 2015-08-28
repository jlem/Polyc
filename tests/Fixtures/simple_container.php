<?php

use Jlem\Polyc\PolicyConfiguration;
use Jlem\Polyc\PolicyContainer;
use Jlem\Polyc\Tests\Fixtures\TestContainer;
use Jlem\Polyc\Tests\Fixtures\TestRuleResolver;

$configuration = new PolicyConfiguration(require 'full_configuration.php');
$resolver = new TestRuleResolver(new TestContainer());
$container = new PolicyContainer($configuration, $resolver);

return $container;
