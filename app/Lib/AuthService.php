<?php

namespace app\Lib;

use app\Model\Admin;
use app\Lib\Registry;

class AuthService
{
    public function isLoggedIn()
    {
        if (!isset($_COOKIE['myid']))
            return null;

        $repository = Registry::get('repository_factory')
            ->createRepository(Admin::class);

        return $repository->getAdminByCookie($_COOKIE['myid']);
    }

}