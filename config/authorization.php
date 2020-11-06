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
            'name' => 'James Bhatta',
            'email' => 'jmsbhatta@gmail.com',
            'password' => 'password',
            'role' => 'admin'
        ],
        [
            'name' => 'John Doe',
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
