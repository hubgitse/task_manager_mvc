<?php

namespace app\Controller;

use app\Lib\Registry;
use app\Model\Task;

class TaskController extends AbstractController
{
    //default action
    public function indexAction($page = 1, $sort = null)
    {

        $authService = Registry::get('auth');
        $admin = $authService->isLoggedIn();

        if ($sort){
            $validator = Registry::get('validator');
            $sort = $validator->validate($sort);
            $sort = substr($sort, 5);
        }

        $repository = Registry::get('repository_factory')
            ->createRepository(Task::class);

        list ($tasks, $pagination) = $repository->findAll($page, $sort);

        $this->renderView('index', ['tasks' => $tasks, 'admin' => $admin, 'pagination' => $pagination]);
    }


    //add new Task action
    public function addAction ()
    {
        $validator = Registry::get('validator');
        $imgUploader = Registry::get('img_uploader');

        $repository = Registry::get('repository_factory')
            ->createRepository(Task::class);

        //validate post data
        $userName = $validator->validate($_POST['username']);
        $mail = $validator->validate($_POST['mail']);
        $taskText = $validator->validate($_POST['tasktext']);
        $completed = $_POST['status'] ? 1 : null;
        $id = $_POST['id'] ? (int) trim($_POST['id']) : null;

        //validate and upload images
        $img = $_FILES['taskimg']['size'] ? $imgUploader->validateAndUpload($_FILES['taskimg']) : null;

        $task = new Task(
            $id,
            $userName,
            $mail,
            $taskText,
            $img,
            $completed
        );

        if (!$repository->save($task)){
            throw new \RuntimeException('Can not add new task');
        }

        $this->redirect('/');
    }

    //get form action
    public function addFormAction ()
    {
        $this->renderView('add.task');
    }

    //edit task action
    public function editAction($id)
    {
        $repository = Registry::get('repository_factory')
            ->createRepository(Task::class);
        $task = $repository->findById($id);

        if (!$task) {
            throw new \RuntimeException('Cannot get task by id');
        }

        $this->renderView('edit.task', ['task' => $task]);
    }

}