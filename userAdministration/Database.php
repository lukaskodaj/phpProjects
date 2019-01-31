<?php

class Database {

    private static $connection;

    public static function connect($host, $user, $password, $database) {
        if (!isset(self::$connection)) {
            self::$connection = new PDO( "mysql:host=$host;dbname=$database", $user,$password, self::$connection);
        }
        return self::$connection;
    }

    public static function query($sql, $parameters = array()) {
        $query = self::$connection->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

}
