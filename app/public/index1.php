<?php

session_start();

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['authenticated'] = false;
}

require __DIR__ . '/../router/patternRouter.php';
require __DIR__ . '/../vendor/autoload.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$routes = [
    'home' => [
        'controller' => 'homeController',
        'method' => 'index',
        'access' => 'all'],
    'grav' => [
        'controller' => 'gravController',
        'method' => 'index',
        'access' => 'all'],
    'yummy' => [
        'controller' => 'yummyController',
        'access' => 'all'],
    'login' => [
        'controller' => 'loginController',
        'access' => 'all'],
    'logout' => [
        'controller' => 'loginController',
        'access' => 'all'],
    'registration' => [
        'controller' => 'registrationController',
        'access' => 'all'],
    'employees' => [
        'controller' => 'UserController',
        'method' => 'index',
        'access' => 'manager',
        'children' => [
            'add' => [
                'controller' => 'UserController',
                'method' => 'addUser',
                'access' => 'manager'
            ],
            'delete' => [
                'controller' => 'UserController',
                'method' => 'deleteUser',
                'access' => 'manager'
            ],
            'getAllAsJSON' => [
                'controller' => 'UserController',
                'method' => 'getAllAsJSON',
                'access' => 'manager'
            ],
            'edit' => [
                'controller' => 'UserController',
                'method' => 'editUser',
                'access' => 'manager'
            ]
        ]
    ]
];
$router = new PatternRouter($routes);
$router->route($uri);