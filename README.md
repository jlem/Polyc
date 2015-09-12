# Polyc

A simple, flexible library for handling encapsulation of policy logic.

All batteries *NOT* included


## Simple Example

```php
// Simple array definition of policies
$policies = [
    'post.delete' => DeletePostPolicy::class
];

// Package into a configuration for validation
$configuration = new Jlem\Polyc\PolicyConfiguration($policies);

// Provide a way to resolve the policies. 
// This part is up to you, Polyc does not ship with any resolvers at present.
$policyResolver = new PimplePolicyResolver($pimpleServicesContainer);

// Create a container with the configuration and resolver
$policyContainer = new PolicyContainer($configuration, $policyResolver);

// Resolve a policy by key
// By default the policy resolves as a singleton
$policy = $policyContainer->make('post.delete');

// Check the policy
if ($policy->check(<args>)) {
    //.... show delete button, etc...
}
```

In the above example, all but the conditional check at the end is boilerplate that you would want to bootstrap into your application.

Policies get resolved as singletons, so if you want to make your policies cache their results, you'll be able to recall the same policy several times and re-use the cached evaluation


## Defining Policies

Polyc makes no assumptions about how the policies are structured. You are free to define whatever method 


## Creating a RuleResolver

Polyc will know how to use the `RuleResolver` you give it, but you will need to make that `RuleResolver` know how to resolve rules you've defined in your application

Here's a simple example for creating a RuleResolver that uses a Pimple dependency container.

```php
class PimpleRuleResolver extends RuleResolverAbstract implements RuleResolver
{
    protected $container;
    
    public function __construct(Pimple\Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * @param string $key
     * @return mixed
     */
    protected function resolveRule($key)
    {
        return $this->container[$key];
    }
}
```


## Enforcers

Enforcers are what actually end up 
