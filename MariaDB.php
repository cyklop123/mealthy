<?php
require_once "db_config.php";

class MariaDB
{
    private $conn = null;
    private $host;
    private $login;
    private $pass;
    private $db;

    public function __construct()
    {
        $this->host = HOST;
        $this->login = LOGIN;
        $this->pass = PASSWORD;
        $this->db = DATABASE;
    }

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db.";charset=utf8", $this->login, $this->pass);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

}