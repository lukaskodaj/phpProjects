<?php


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