<?php


class Data
{
    public $meno;
    public $priezvisko;
    public $rokNarodenia;
    public $aktualnyVek;
    public $id;

    /**
     * Data constructor.
     * @param $meno
     * @param $priezvisko
     * @param $rokNarodenia
     */
    public function __construct($meno, $priezvisko, $rokNarodenia)
    {
        $this->meno = $meno;
        $this->priezvisko = $priezvisko;
        $this->rokNarodenia = $rokNarodenia;
        $this->aktualnyVek = $this->vypocitajVek();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function vypocitajVek()
    {
        return date("Y") - $this->rokNarodenia;
    }

    /**
     * @return mixed
     */
    public function getMeno()
    {
        return $this->meno;
    }

    /**
     * @return mixed
     */
    public function getPriezvisko()
    {
        return $this->priezvisko;
    }

    /**
     * @return mixed
     */
    public function getRokNarodenia()
    {
        return $this->rokNarodenia;
    }

    /**
     * @return mixed
     */
    public function getAktualnyVek()
    {
        return $this->aktualnyVek;
    }

}