<?php
require_once 'AppController.php';
require_once __DIR__.'/../Repositories/MealRepository.php';

class MainController extends AppController
{
    public function summary()
    {
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }

        $message = '';

        if($this->isPost())
        {
            $meal = isset($_POST['meal']) ? trim($_POST['meal']) : '';
            $choosed = isset($_POST['choosed']) ? trim($_POST['choosed']) : '';
            $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';
            $date = isset($_POST['date']) ? trim($_POST['date']) : date('Y-m-d');

            if($meal == '')
            {
                $message = 'Brak wybranego posiłku!';
                goto a;
            }

            if($choosed == '')
            {
                $message = 'Brak wybranego produktu!';
                goto a;
            }

            if($quantity == '')
            {
                $message = 'Brak wybranego produktu!';
                goto a;
            }

            if($quantity <= 0)
            {
                $message = 'Ilość produktu musi być większ od 0!';
                goto a;
            }

            $repo = new MealRepository();


            if(!$repo->ifMealExist($meal) && !$repo->ifProductExist($choosed))
            {
                $message = "Niepoprawne dane";
                goto a;
            }

            if($repo->setEats($_SESSION['id'], $choosed, $meal, $quantity, $date))
                $message = "Dodano produkt";
            else
                $message = "Błąd przy dodawaniu";

        }
        a:

        $repository = new MealRepository();

        $eats = $repository->getEats($_SESSION['id'], date('Y-m-d'));

        $this->render('summary',['eats'=>$eats,'message'=>$message]);
    }

    public function chooseProduct()
    {
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }
        $this->render('choose_product');
    }

    public function deleteProduct()
    {
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }

        if($this->isGet() && isset($_GET['id']))
        {
            $id = trim($_GET['id']);
            $repository = new MealRepository();
            if($eat = $repository->getEat($id)) {
                if ($eat['user_id'] != $_SESSION['id']) {
                    echo 'null';
                    return;
                }
            }
            else{
                echo '0';
                return;
            }
            echo $repository->deleteEat($id);
            return;
        }
        echo 'null';
    }

    public function getProducts(){
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }

        if($this->isGet() && isset($_GET['name'])) {

            $name = trim($_GET['name']);

            $repository = new MealRepository();

            $products = $repository->getProducts($name);

            header("Content-type: json");
            echo $products ? json_encode($products) : '[]';
            return;
        }
        echo "[]";
    }

    public function addProduct(){
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }
        if($_SESSION['role'] < 2)
        {
            echo 'Nie masz uprawnień aby dodawać produkty do bazy';
            return;
        }
        $message = '';
        if($this->isPost())
        {
            $name = isset($_POST['poduct_name']) ? trim($_POST['poduct_name']) : '';
            $cal = isset($_POST['callories']) ? trim($_POST['callories']) : '';
            $prot = isset($_POST['proteins']) ? trim($_POST['proteins']) : '';
            $fat = isset($_POST['fats']) ? trim($_POST['fats']) : '';
            $carb = isset($_POST['carbs']) ? trim($_POST['carbs']) : '';

            if($name == '' || $cal == '' || $prot == '' || $fat == '' || $carb == '')
            {
                $message = "Uzupełnij wszystkie pola";
                goto a;
            }

            if(!is_numeric($cal) || !is_numeric($prot) || !is_numeric($fat) || !is_numeric($carb))
            {
                $message = "Podane wartości nie są wartościami liczbowymi";
                goto a;
            }
            $prod = new Product($name, 100, $cal, $prot, $fat, $carb);

            $repository = new MealRepository();
            if($repository->addProduct($prod))
                $message = "Dodano produkt: ".$name;
            else
                $message = "Błąd przy dodawaniu produktu";
        }
        a:

        $this->render('add_product',['message'=>$message]);
    }

    public function getSummary()
    {
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }
        if($this->isGet()) {
            $date = isset($_GET['date']) ? trim($_GET['date']) : '';

            if ($date != '') {
                $repository = new MealRepository();

                $eats = $repository->getEats($_SESSION['id'], $date);

                header("Content-type: json");
                echo '[';
                foreach ($eats as $meal_id=>$obj)
                {
                    echo json_encode($obj);
                    if($meal_id !== array_key_last($eats))
                        echo ',';
                }
                echo ']';

                return;
            }
        }
        echo "[]";
    }
}