<?php

namespace app\Model;


use app\Lib\Pagination;
use app\Model\Task;
use app\Lib\Registry;

class TaskRepository extends AbstractRepository
{
    private $connection;

    /**
     * TaskRepository constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param \app\Model\Task $task
     * @return mixed
     */
    public function save(Task $task)
    {
        if ($task->getId() === null) {

            // INSERT into db
            $stmt = $this->connection->prepare(
                'INSERT INTO `tasks` (user_name, mail, text, img, completed) VALUES (?, ?, ?, ?, ?)'
            );
            $stmt->bindParam(1, $task->getUserName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $task->getMail(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $task->getTaskText(), \PDO::PARAM_STR);
            $stmt->bindParam(4, $task->getImg(), \PDO::PARAM_STR);
            $stmt->bindParam(5, $task->isCompleted(), \PDO::PARAM_BOOL);

           return $stmt->execute();

        } else {
            //UPDATE
            $stmt = $this->connection->prepare(
                'UPDATE `tasks` SET user_name = ?, mail = ?, text = ?, completed = ? WHERE id = ?'
            );
            $stmt->bindParam(1, $task->getUserName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $task->getMail(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $task->getTaskText(), \PDO::PARAM_STR);
            $stmt->bindParam(4, $task->isCompleted(), \PDO::PARAM_INT);
            $stmt->bindParam(5, $task->getId(), \PDO::PARAM_INT);

            return $stmt->execute();
        }
    }

    /**
     * @param $page
     * @param $sort
     * @return array
     */
    public function findAll($page, $sort)
    {
        $pagination = Pagination::getPagination($page, $sort);

        $from = $pagination->getFrom();

        $num = $pagination->getNum();

        if ($sort){
            if($sort === 'completed'){
                $query = "SELECT * FROM tasks ORDER BY $sort DESC LIMIT $from, $num";
            }else{
                $query = "SELECT * FROM tasks ORDER BY $sort LIMIT $from, $num";
            }
        }else{
            $query = "SELECT * FROM tasks LIMIT $from, $num";
        }

        $stmt = $this->connection->query($query);

        $tasks = [];

        foreach ($stmt->fetchAll() as $row) {
            $tasks[] = $this->createTaskFromArray($row);
        }

        return array ($tasks, $pagination);
    }

    /**
     * @return int
     */
    public function countAll()
    {
        $stmt = $this->connection->query("SELECT COUNT(*) FROM tasks");
        $result = (int) $stmt->fetchColumn();

        return $result;
    }

    /**
     * @param $id
     * @return \app\Model\Task|null
     */
    public function findById($id)
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM `tasks` WHERE id = ?'
        );
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);

        $stmt->execute();

        if ($row = $stmt->fetch()) {
            return $this->createTaskFromArray($row);
        }

        return null;
    }


    //create model from array
    private function createTaskFromArray(array $row)
    {
        return new Task(
            $row['id'],
            $row['user_name'],
            $row['mail'],
            $row['text'],
            $row['img'],
            $row['completed']
        );
    }


}