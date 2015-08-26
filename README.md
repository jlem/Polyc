# Polyc

A rule-based access control mechanism for building flexible encapsulation of policy logic.

All batteries *NOT* included


## Use Case

This library was designed to make it easy to define and wrap re-usable business rules together as a named policy that can be boolean checked, or return a pre-configured response (e.g. a redirect if the policy request fails)

Polyc is not an access control list, it is a way to *wrap* an access control list together with other logical access rules, and then re-use that policy in various places (e.g. don't show GUI button if criteria aren't met, or redirect with a flash message depending on which criteria was not met)


## Simple Example

```php
// Simple array definition of policies
$policies = [
    'tournament.start' => [
        'Rules\StaffMemberHasPermission',
        'Rules\TournamentSystemEnabled',
        'Rules\TournamentNotAlreadyRunning',
    ]
];

// Package into a configuration for validation
$configuration = new Jlem\Polyc\PolicyConfiguration($policies);

// Provide a way to resolve the rules. 
// This part is up to you, Polyc does not ship with any rule resolvers at present.
// The rules themselves are up to you to configure
$ruleResolver = new PimpleRuleResolver($pimpleServicesContainer);

// Create a container with the configuration and resolver
$policyContainer = new PolicyContainer($configuration, $ruleResolver);

// Instantiate an enforcer
$enforcer = new BooleanPolicyEnforcer($policyContainer);

// Check the policy
if ($enforcer->check('tournament.start')) {
    //.... show start button, etc...
}
```

In the above example, all but the conditional check at the end is boilerplate that you would want to bootstrap into your application.

Policy results are singletons, so calling `$enforcer->check(...)` several times in the same request wont need to re-execute the queries/logic contained within each rule.


## Defining Rules

Polyc ships with an interface and a trait to make it easy to bolt testable behavior onto any existing business rules you might have.

Here's an example:

```php
class StaffMemberHasPermission implements Jlem\Polyc\Rule\Testable
{
    use Jlem\Polyc\Rule\Rule;
    
    protected $member;
    
    public function __construct(Member $member)
    {
        $this->member = $member;
    }
    
    /**
     * Checks whether the rule evaluates to true or not
     * @param Policy $policy
     * @return bool
     */
    protected function evaluate(Jlem\Polyc\Policy $policy)
    {
        return $this->member->can($policy->getKey());
        
        // e.g. $this->member->can('tournament.start');
    }
}
```

`evaluate()` should return a boolean response.

Note that it is up to you to define your business rules with any dependencies they may need, and make them resolvable in some way.


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
