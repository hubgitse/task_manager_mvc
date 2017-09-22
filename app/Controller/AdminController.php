<?php

namespace app\Controller;

use app\Model\Admin;
use app\Lib\Registry;

class AdminController extends AbstractController
{
    //login form
    public function loginFormAction()
    {
        $this->renderView('login.admin.form');
    }

    //trying to login
    public function loginAdminAction()
    {
        $validator = Registry::get('validator');

        $login = $validator->validate($_POST['login']);
        $pass = $_POST['pass'];

        $repository = Registry::get('repository_factory')
            ->createRepository(Admin::class);

        $admin = $repository->getAdmin($login, $pass);

        //generate cookie
        $cookie = md5(rand(1000,9999).$admin->getLogin().rand(1000,9999).$admin->getLogin().rand(1000,9999));

        //isnsert cookie into db if true set cookie
        if($repository->insertCookieIntoDatabase($cookie, $admin)){
            setcookie('myid', $cookie,  time() + 3600, '/');
            $this->redirect('/');
        }
    }
}