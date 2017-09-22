<?php

namespace app\Model;


class AdminRepository extends AbstractRepository
{

    private $connection;

    /**
     * AdminRepository constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $login
     * @param $pass
     * @return Admin
     */
    public function getAdmin($login, $pass)
    {
        $stmt = $this->connection->prepare("SELECT * FROM admin WHERE login = (?)");
        $stmt->bindParam(1, $login, \PDO::PARAM_STR);

        $stmt->execute();

        $row = $stmt->fetch();

        if (!$row)
            throw new \RuntimeException('No admin found');

        if ($row['pass'] !== $this->encodePass($pass))
            throw new \RuntimeException('Password is wrong');


        return new Admin($row['login'], $row['pass']);

    }

    /**
     * @param $cookie
     * @param Admin $admin
     * @return mixed
     */
    public function insertCookieIntoDatabase($cookie, Admin $admin){

        //deleting old cookies from db
        $stmt = $this->connection->prepare("DELETE FROM admin_cookie WHERE login = (?)");
        $stmt->bindParam(1, $admin->getLogin(), \PDO::PARAM_STR);
        $stmt->execute();

        //add new cookies into db
        $stmt = $this->connection->prepare("INSERT INTO admin_cookie (login, cookie) VALUES (?,?)");
        $stmt->bindParam(1, $admin->getLogin(), \PDO::PARAM_STR);
        $stmt->bindParam(2, $cookie, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * @param $cookie
     * @return Admin|null
     */
    public function getAdminByCookie($cookie)
    {
        $stmt = $this->connection->prepare("SELECT * FROM admin ad JOIN admin_cookie ac on ac.login = ad.login WHERE ac.cookie = (?)");
        $stmt->bindParam(1, $cookie, \PDO::PARAM_STR);
        $stmt->execute();

        if ($row = $stmt->fetch()) {
            return new Admin($row['login'], $row['pass']);
        }

        return null;
    }

    //get encoded pass
    private function encodePass($pass)
    {
        return md5($pass);
    }
}