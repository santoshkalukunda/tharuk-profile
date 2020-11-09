<?php
return [
    /*
    * The roles required by the application
    */
    'roles' => [
        'admin',
        'seller',
        'customer',
    ],

    /*
    *  Default users which will be seeded
    */
    'users' => [
        [
            'first_name' => 'James',
            'last_name' => 'Bhatta',
            'email' => 'jmsbhatta@gmail.com',
            'password' => 'password',
            'role' => 'admin'
        ],
        [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@gexample.com',
            'password' => 'password',
            'role' => 'user'
        ],
    ],

    /*
    * List of permissions to be register
    */
    'permissions' => [],
];
