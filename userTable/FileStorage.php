<?php
/**
 * Created by PhpStorm.
 * User: hrko
 * Date: 13. 11. 2018
 * Time: 16:48
 */

class FileStorage implements IStorage
{
    const FILE_NAME = "data.csv";
    /**
     * @param Data $data
     * @return mixed
     */
    public function store(Data $data)
    {
        $file = fopen(self::FILE_NAME, "a+");
        if ($file) {
            fwrite($file, $this->getLine($data));
            fclose($file);
        }
    }

    /**
     * @return Data[]
     */
    public function getAllData($str, $stlpec, $sort)
    {
        $result = [];
        $file = fopen(self::FILE_NAME, "r");
        if ($file) {
            while (($line = fgets($file)) != false ) {
                $parse = explode(";", $line);
                $result[] = new Data($parse[0],$parse[1],$parse[2]);
            }
            return $result;
        }
    }

    private function getLine(Data $data) {
        return $data->getNazov().';'.$data->getPopis().';'.$data->getDatum()."\n";
    }
}