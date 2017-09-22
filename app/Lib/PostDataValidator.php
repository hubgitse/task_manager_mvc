<?php

namespace app\Lib;


class PostDataValidator
{
	private $pdo;
	
	function __construct()
	{
		$this->pdo = $pdo;
	}
    /**
     * @param $str
     * @return string
     */
    public function validate($str)
    {
        //if empty - new exception
        if (!$str)
            throw new \RuntimeException('All fields must be filled');

        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);
        $str = stripslashes($str);
		
		
        return $str;
    }

}