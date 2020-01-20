<?php
require_once "AppController.php";
require_once __DIR__.'/../Models/User.php';

class SecurityController extends AppController
{

    public function login()
    {
        if ($this->isPost())
        {
            $login = $_POST['login'] ? trim($_POST['login']) : '';
            $pass = $_POST['password'] ? trim($_POST['password']) : '';

            $user = new User('jan@nowak.pl','admin');

            if($user->getLogin() != $login)
            {
                $this->render('login', ['message'=>'Użytkownik o takim emailu nie istnieje']);
                return;
            }

            if($user->getPassword() != $pass)
            {
                $this->render('login', ['message'=>'Błędne hasło']);
                return;
            }

            $http = $_SERVER['HTTP_HOST'];
            header("Location: http://".$http."?page=summary");

            return;
        }
        $this->render('login');
    }
}