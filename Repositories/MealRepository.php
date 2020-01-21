<?php
require_once 'Repository.php';
require_once __DIR__.'/../Models/Product.php';

class MealRepository extends Repository
{
    public function getEats(int $id) : array
    {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("SELECT * FROM summary WHERE user_id=:id");
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();

        $eats = $this->getMeals();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $prod = new Product($row['product_name'], $row['quantity'], $row['callories'], $row['proteins'], $row['fats'], $row['carbs'], $row['product_id']);
            $eats[(int)$row['meal_id']]['products'][] = $prod;
        }
        return $eats;
    }

    public function getMeals(): array {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("SELECT * FROM meals");
        $stmt->execute();

        $eats = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $eats[(int)$row['meal_id']] = [
                    'name' => $row['meal_name'],
                    'products' => []
                ];
        }
        $conn=null;
        return $eats;
    }
}