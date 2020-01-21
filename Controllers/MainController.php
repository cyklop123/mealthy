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

        $repository = new MealRepository();

        $eats = $repository->getEats($_SESSION['id']);

        //echo '<pre>';
        //print_r($eats);
        //exit();

        $this->render('summary',['eats'=>$eats]);
    }
}