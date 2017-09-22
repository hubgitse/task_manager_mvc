<?php


namespace app\Model;


class Task
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $taskText;

    /**
     * @var string
     */
    private $img;

    /**
     * @var integer
     */
    private $completed;

    /**
     * Task constructor.
     * @param $userName
     * @param $mail
     * @param $taskText
     * @param $img
     */
    public function __construct($id, $userName, $mail, $taskText, $img = null, $completed = 0)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->mail = $mail;
        $this->taskText = $taskText;
        $this->img = $img;
        $this->completed = $completed;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return srting
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getTaskText()
    {
        return $this->taskText;
    }

    /**
     * @param string $taskText
     */
    public function setTaskText($taskText)
    {
        $this->taskText = $taskText;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * @param bool $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

}