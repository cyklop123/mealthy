<?php
require_once 'Repository.php';
require_once __DIR__.'/../Models/Product.php';

class MealRepository extends Repository
{
    public function getEats(int $id, string $data) : array
    {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("SELECT * FROM summary WHERE user_id=:id AND data=:data");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        $stmt->execute();

        $eats = $this->getMeals();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $prod = new Product($row['product_name'], $row['quantity'], $row['callories'], $row['proteins'], $row['fats'], $row['carbs'], $row['eat_id']);
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

    public function getProducts(string $name): array
    {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("SELECT * FROM products WHERE MATCH(product_name) AGAINST(:name) LIMIT 10");
        //$stmt = $conn->prepare("SELECT * FROM products WHERE MATCH(product_name) AGAINST(:name WITH QUERY EXPANSION) LIMIT 10");
        //$stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE :name LIMIT 10");
        $name = '%'.$name.'%';
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $products = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $products[] = $row;
        }

        $conn = null;
        return $products;
    }

    public function ifMealExist(int $id) : bool
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM meals WHERE meal_id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() == 0)
            return false;
        return true;
    }

    public function ifProductExist(int $id) : bool
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() == 0)
            return false;
        return true;
    }

    public function getEat(int $id): ?array
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM eats WHERE eat_id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            return $row;
        }
        return null;
    }

    public function deleteEat(int $id)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("DELETE FROM eats WHERE eat_id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();

    }

    public function setEats(int $user_id, int $product_id, int $meal_id, float $quantity, string $date): bool
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO eats VALUES(NULL,:user,:product,:meal,:quantity,:date)");
        $stmt->bindParam(":user", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":product", $product_id, PDO::PARAM_INT);
        $stmt->bindParam(":meal", $meal_id, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", strval($quantity), PDO::PARAM_STR);
        $stmt->bindParam(":date", $date);

        if($stmt->execute())
            return true;
        else
            return false;
    }

    public function addProduct(Product $obj) : bool
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO products VALUES(NULL,:name,:cal,:prot,:fat,:carb)");
        $stmt->bindParam(":name", $obj->getName(), PDO::PARAM_STR);
        $stmt->bindParam(":cal", strval($obj->getCallories()), PDO::PARAM_STR);
        $stmt->bindParam(":prot", strval($obj->getProteins()), PDO::PARAM_STR);
        $stmt->bindParam(":fat", strval($obj->getFats()), PDO::PARAM_STR);
        $stmt->bindParam(":carb", strval($obj->getCarbs()), PDO::PARAM_STR);
        if($stmt->execute())
            return true;
        else
            return false;
    }

}