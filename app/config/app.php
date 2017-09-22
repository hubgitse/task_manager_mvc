<?php

$params = require 'params.php';
$dataBase = $params['db'];

return [
    'database' => [
        'host' => $params['db']['db_host'],
        'db' => $params['db']['db_name'],
        'user' => $params['db']['db_user'],
        'password' => $params['db']['db_pass'],
    ],

    'upload_dir' =>__DIR__.'/../'.$params['upload_dir'],

    'img_size' => [
        'width' => $params['img_size']['max_width'],
        'height' => $params['img_size']['max_height']
    ],

    'max_img_height' => $params['max_img_height'],

    'tasks_per_page' => $params['tasks_per_page'],

    'routes' => [
        'default' => [
            'path' => '^/(\d+)?[/]?(sort=(mail|user_name|completed))?$',
            'controller' => \app\Controller\TaskController::class,
            'method' => 'GET',
        ],

        'task_add_form' => [
            'path' => '^/task/add[/]?$',
            'controller' => \app\Controller\TaskController::class,
            'action' => 'addForm',
            'method' => 'GET',
        ],

        'task_add' => [
            'path' => '^/task/add[/]?$',
            'controller' => \app\Controller\TaskController::class,
            'action' => 'add',
            'method' => 'POST',
        ],

        'admin_login_form' => [
            'path' => '^/login[/]?$',
            'controller' => \app\Controller\AdminController::class,
            'action' => 'loginForm',
            'method' => 'GET',
        ],
        'admin_login' => [
            'path' => '^/login[/]?$',
            'controller' => \app\Controller\AdminController::class,
            'action' => 'loginAdmin',
            'method' => 'POST',
        ],
        'edit_task' => [
            'path' => '^/edit/(\d+)[/]?$',
            'controller' => \app\Controller\TaskController::class,
            'action' => 'edit',
            'method' => 'GET',
        ],
    ]
];