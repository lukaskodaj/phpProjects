<?php
/**
 * Created by PhpStorm.
 * User: hrko
 * Date: 13. 11. 2018
 * Time: 17:27
 */

class DBStorage implements IStorage
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '123456789','vaii');
        $this->checkDBErrors();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function store(Data $data)
    {
        $sql = "INSERT INTO person(meno, priezvisko, rokNarodenia, aktualnyVek) VALUES ('".$data->getMeno()."','".$data->getPriezvisko()."','".$data->getRokNarodenia()."','".$data->getAktualnyVek()."')";
        $this->db->query($sql);
        $this->checkDBErrors();
    }

    /**
     * @return Data[]
     */
    public function getAllData($str, $stlpec, $sort)
    {

        $fromRow = $str * 5 - 5;
        $toRow = 5;

        if($stlpec == "none")
        {
            $sql = "SELECT * FROM (SELECT * FROM person LIMIT ".$fromRow.", ".$toRow.") as tb";
        } else {
            $sql = "SELECT * FROM (SELECT * FROM person LIMIT ".$fromRow.", ".$toRow.") as tb ORDER BY ".$stlpec." ".$sort;
        }

        $result = [];
        //$sql = "SELECT * FROM person";


        $dbResult = $this->db->query($sql);
        if ($dbResult->num_rows > 0) {
            while ($row = $dbResult->fetch_assoc()) {
                $data = new Data($row['meno'], $row['priezvisko'], $row['rokNarodenia']);
                $data->setId($row['id']);
                $result[] = $data;
            }
        }
        return $result;
    }

    public function getDataCount()
    {
        $sql = "SELECT * FROM person";
        $dbResult = $this->db->query($sql);
        return $dbResult->num_rows;
    }

    public function removeData($id)
    {
        $sql = "DELETE FROM person WHERE id='".$id."'";
        $this->db->query($sql);
        $this->checkDBErrors();
    }

    private function checkDBErrors() {
        if ($this->db->error) {
            echo "Chyba:". $this->db->error;
            die();
        }
    }

}