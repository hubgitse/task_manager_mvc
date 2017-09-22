<?php

namespace app\Lib;

use app\Model\AbstractRepository;

class RepositoryFactory implements RepositoryFactoryInterface
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * RepositoryFactory constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createRepository($className)
    {

        $repositoryClassName = sprintf('%sRepository', $className);

        if (!class_exists($repositoryClassName)) {
            throw new \InvalidArgumentException();
        }

        $repository = new $repositoryClassName($this->connection);

        if (!$repository instanceof AbstractRepository) {
            return null;
        }

        return $repository;
    }
}