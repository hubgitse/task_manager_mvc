<?php

use app\Lib\Registry;

// Bootstraping the application

require __DIR__.'/../autoloader.php';

$config = require __DIR__.'/config/app.php';
$db = $config['database'];

$pdo = new \PDO(
    sprintf('mysql:dbname=%s;host=%s', $db['db'], $db['host']),
    $db['user'],
    $db['password']
);

Registry::set('pdo', $pdo);

Registry::set(
    'router',
    new \app\Lib\Router($config['routes'])
);

Registry::set('view', new \app\Lib\View());

Registry::set('repository_factory', new \app\Lib\RepositoryFactory($pdo));

Registry::set('validator', new \app\Lib\PostDataValidator());

Registry::set('img_uploader', new \app\Lib\ImgUploader());

Registry::set('auth', new \app\Lib\AuthService());

Registry::setParameter('upload_dir', $config['upload_dir']);

Registry::setParameter('max_img_width', $config['img_size']['width']);

Registry::setParameter('max_img_height', $config['img_size']['height']);

Registry::setParameter('pagination', $config['tasks_per_page']);

Registry::readOnly();
