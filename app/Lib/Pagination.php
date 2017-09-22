<?php


namespace app\Lib;

use app\Lib\Registry;
use app\Model\Task;

class Pagination
{

    private $page;

    private $from;

    private $num;

    private $total;

    private $sort;

    /**
     * Pagination constructor.
     * @param $page
     * @param $from
     * @param $num
     * @param $total
     */
    public function __construct($page, $from, $num, $total, $sort)
    {
        $this->page = $page;
        $this->from = $from;
        $this->num = $num;
        $this->total = $total;
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num)
    {
        $this->num = $num;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $total
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @param $page
     * @param $sort
     * @return static
     */
    public static function getPagination($page, $sort)
    {
        $num = Registry::getParameter('pagination');

        $repository = Registry::get('repository_factory')
            ->createRepository(Task::class);

        $result = $repository->countAll();

        $total = intval(($result - 1) / $num) + 1;

        $page = intval($page);

        if(empty($page) or $page < 0) $page = 1;
        if($page > $total) $page = $total;
        $from = $page * $num - $num;

        return new static($page, $from, $num, $total, $sort);
    }


    //generate html of pagination
    public function makePaginationHtml()
    {
        //check sort parameter
        if ($this->sort) $sort = 'sort='.$this->sort;

        //generate parts of pagination
        if ($this->page != 1) $first = '<a href= /1/'.$sort.'><<</a> 
                              <a href= /'. ($this->page - 1) .'/'.$sort.'><</a> ';

        if ($this->page !=  $this->total) $next = ' <a href= /'. ($this->page + 1) .'/'.$sort.'>></a>  
                                   <a href= /' . $this->total. '/'.$sort.'>>></a>';

        if($this->page - 2 > 0) $left2 = ' <a href= /'. ($this->page - 2) .'/'.$sort.'>'. ($this->page - 2) .'</a>';
        if($this->page - 1 > 0) $left1 = '<a href= /'. ($this->page - 1) .'/'.$sort.'>'. ($this->page - 1) .'</a>';
        if($this->page + 2 <=  $this->total) $right2 = '<a href= /'. ($this->page + 2) .'/'.$sort.'>'. ($this->page + 2) .'</a>';
        if($this->page + 1 <=  $this->total) $right1 = '<a href= /'. ($this->page + 1) .'/'.$sort.'>'. ($this->page + 1) .'</a>';


        return '<ul class="pagination"><li>'.$first.'</li>'
            .'<li>'.$left2.$left1.'</li>'.'<li class="active"><a>'
            .$this->page.'</a></li>'.'<li>'.$right1.'</li>'
            .'<li>'.$right2.'</li>'.'<li>'.$next.'</li></ul>';
    }

}