<?php

$policy->setResolver(...);


$policy->set('league.enable',
    [
        'MemberHasPermission',
        'StaffHasJurisdiction',
        'SectionCanHaveLeague',
        'SectionDoesNotHaveLeague'
    ],
    [
        'acl' => true,
        'title' => 'Enable League',
        'description' => 'Allows member to enable the league for the section'
    ]
);

// resolves the rules out of the container you provided and creates a new policy with them.

$policy->set('league.enable', [
    'rules' => [
        'MemberHasPermission',
        'StaffHasJurisdiction',
        'SectionCanHaveLeague',
        'SectionDoesNotHaveLeague'
    ],
    'attributes' => [
        'isPermission' => true,
        'title' => 'Enable League',
        'description' => 'Allows member to enable the league for the section'
    ]
])

$policy->set('league.enable', [
    'MemberHasPermission',
    'StaffHasJurisdiction',
    'SectionCanHaveLeague',
    'SectionDoesNotHaveLeague'
], [
    'title' => 'Enable League',
    'description' => 'Allows member to enable to the league for the section'
]);

$policy->delegate('league.enable', 'SomeHandler');

// Maybe?
$policy->get($key);

// Maybe?
$policy->check($key);

// Returns a response
$response = $policy->ask($key);

// PolicyResponse
$response->approved(); // All tests passed
$response->denied(); // At least one test failed
$response->violations(); // Array of test results

// Single rule API.
// Keep as simple as possible to minimize trait conflicts,
// and make interface satisfaction as easy as possible
$test = $rule->test($policy);

// RuleTest
$test->passed(); // Test completed, and passed
$test->failed(); // Test completed, but failed
$test->failureCode(); // arbitrary code assigned to test in the event it failed
$test->completed(); // Test actually completed
$test->result(); // TestResult::PASSED, TestResult::FAILED, TestResult::UNKNOWN (e.g. service threw some kind of error)

// Create an enforcer with a response handler
$enforcer = new PolicyEnforcer($policy);
$enforcer = new ResponsePolicyEnforcer($policy, $responseHandlerFactory);

// enforcer API
$enforcer->check(); // boolean
$enforcer->bounce(); // returns whatever was configured by response handler
