<?php
require_once 'User.php';

class UserDetails extends User
{
    protected $age,$size, $weight, $male;
    public function __construct($login, $password, $id, $role, $age, $size, $weight, $male)
    {
        parent::__construct($login, $password, $id, $role);
        $this->age = $age;
        $this->size = $size;
        $this->weight = $weight;
        $this->male = $male;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getSize()
    {
        return $this->size;
    }


    public function getWeight()
    {
        return $this->weight;
    }

    public function getMale()
    {
        return $this->male;
    }

}