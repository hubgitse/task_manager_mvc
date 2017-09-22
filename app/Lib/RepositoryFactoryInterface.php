<?php

namespace app\Lib;

use app\Model\AbstractRepository;


interface RepositoryFactoryInterface
{
    /**
     * @param string $className
     * @return AbstractRepository|null
     * @throws \Exception
     */
    public function createRepository($className);
}