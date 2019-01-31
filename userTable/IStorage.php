<?php
/**
 * Created by PhpStorm.
 * User: hrko
 * Date: 13. 11. 2018
 * Time: 16:46
 */

interface IStorage
{
    /**
     * @param Data $data
     * @return mixed
     */
    public function store(Data $data);

    /**
     * @return Data[]
     */
    public function getAllData($str, $stlpec, $sort);
}