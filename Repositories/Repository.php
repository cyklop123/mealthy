<?php
require_once __DIR__.'/../MariaDB.php';

class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = new MariaDB();
    }
}
