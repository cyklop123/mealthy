<?php


class Product
{
    private $name;
    private $quantity;
    private $callories;
    private $proteins;
    private $fats;
    private $carbs;
    private $id;

    public function __construct($name,$quantity, $callories, $proteins, $fats, $carbs, $id=null)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->callories = $callories;
        $this->proteins = $proteins;
        $this->fats = $fats;
        $this->carbs = $carbs;
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCallories()
    {
        return $this->callories;
    }

    public function getProteins()
    {
        return $this->proteins;
    }

    public function getFats()
    {
        return $this->fats;
    }

    public function getCarbs()
    {
        return $this->carbs;
    }

    public function getId()
    {
        return $this->id;
    }
}