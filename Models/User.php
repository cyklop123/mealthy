<?php


class User
{
    private $login, $password, $role,$id;

    public function __construct($login, $password, $id=0, $role=1)
    {
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
        $this->id = $id;
    }

    public function getLogin():string
    {
        return $this->login;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function getRole():string
    {
        return $this->role;
    }

    public function getId(): int
    {
        return $this->id;
    }

}