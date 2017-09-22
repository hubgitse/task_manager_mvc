<?php

spl_autoload_register(function ($class) {
    $path = preg_replace('#\\\#', '/', $class);

    require $path.'.php';
});