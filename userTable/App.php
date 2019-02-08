<?php

class App
{
    /**
     * @var IStorage
     */
    private $storage;
    private $zobrazForm = true;
    private $str;
    private $stlpec;
    private $sort;


    public function __construct()
    {
        //$this->storage = new FileStorage();
        $this->storage = new DBStorage();

        if ((isset($_GET['akcia']) and $_GET['akcia'] == "vypis") || isset($_GET['remove']) || isset($_GET['page'])) {
            $this->zobrazForm = false;
        }

        if($this->zobrazForm == false)
        {
            if(isset($_GET['page']))
            {
                $this->str = $_GET['page'];
            } else {
                $this->str = 1;
            }

            if(isset($_GET['stlpec']))
            {
                $this->stlpec = $_GET['stlpec'];
            } else {
                $this->stlpec = "none";
            }

            if(isset($_GET['sort']))
            {
                $this->sort = $_GET['sort'];
            } else {
                $this->sort = "asc";
            }
        }

        if(isset($_GET['remove']))
        {
            $this->storage->removeData($_GET['remove']);
        }

        if (isset($_POST['odoslat'])) {
            $this->storage->store(new Data($_POST['meno'], $_POST['priezvisko'], $_POST['rokNarodenia']));
        }
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getStlpec()
    {
        return $this->stlpec;
    }

    /**
     * @return Data[]
     */
    public function getData($str, $stlpec, $sort) {
        return $this->storage->getAllData($str, $stlpec, $sort);
    }

    public function getDataCount()
    {
        return $this->storage->getDataCount();
    }

    /**
     * @return mixed
     */
    public function zobrazForm()
    {
        return $this->zobrazForm;
    }

    /**
     * @return int
     */
    public function getStr()
    {
        return $this->str;
    }

}