<?php

return [
    'foo.bar' => [
        'rules' => [
            'Jlem\Polyc\Tests\Fixtures\FooRule'
        ],
        'attributes' => [
            'acl' => true,
            'title' => 'Lorem ipsum',
            'description' => 'Lorem ipsum dolor sit amet.'
        ]
    ],
    'bar.baz' => [
        'rules' => [
            'Jlem\Polyc\Tests\Fixtures\FailingFooRule',
            'Jlem\Polyc\Tests\Fixtures\BazRule'
        ],
        'attributes' => [
            'acl' => false,
            'title' => 'Lorem ipsum',
            'description' => 'Lorem ipsum dolor sit amet.'
        ]
    ],
    'baz.baz' => [
        'rules' => [
            'Jlem\Polyc\Tests\Fixtures\BarRule',
            'Jlem\Polyc\Tests\Fixtures\BazRule'
        ],
        'attributes' => []
    ]
];
