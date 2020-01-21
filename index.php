<?php
require_once "Routing.php";
/*
$db = new MariaDB();

$conn = $db->connect();

$file = fopen("data.txt", 'r');

echo '<pre>';

$stmt = $conn->prepare("INSERT INTO products(name, callories, proteins, fats, carbs) values(:nam, :cal, :prot, :fat, :carb)");
$conn->beginTransaction();
$i=0;
while(!feof($file))
{
    $i++;
    $line = fgets($file);
    $product = explode(' | ', $line);
    if(strcasecmp($product[0],"kuriozalne") == 0 || $product[0] == '')
        continue;

    $stmt->bindParam(':nam',$product[0],PDO::PARAM_STR);
    $stmt->bindParam(':cal',str_replace(',','.',strval($product[1])),PDO::PARAM_STR);
    $stmt->bindParam(':prot',str_replace(',','.',strval($product[2])),PDO::PARAM_STR);
    $stmt->bindParam(':fat',str_replace(',','.',strval(substr($product[4], 0,-1))),PDO::PARAM_STR);
    $stmt->bindParam(':carb',str_replace(',','.',strval($product[3])),PDO::PARAM_STR);
    $stmt->execute();
    echo $i." ".$product[0].'|'.$product[1].'|'.$product[2].'|'.substr($product[4], 0,-1).'|'.$product[3]."\n";
}
$conn->commit();
$conn = null;
*/
$routing = new Routing();
$routing->route();