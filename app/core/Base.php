<?php

class Base
{
    public static function connect()
    {
        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";char=" . DB_CHARSET;
        try {
            $config = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $dbh = new PDO($dsn, DB_USER, DB_PASSWORD, $config);
            return  $dbh;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}
