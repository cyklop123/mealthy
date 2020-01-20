<?php
require_once "db_config.php";

class MariaDB
{
    private $conn;
    private $host;
    private $login;
    private $pass;
    private $db;

    public function __construct()
    {
        $host = HOST;
        $login = LOGIN;
        $pass = PASSWORD;
        $db = DATABASE;
    }


}