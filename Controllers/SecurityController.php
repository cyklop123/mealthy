<?php
require_once "AppController.php";
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Repositories/UserRepository.php';

class SecurityController extends AppController
{

    public function login()
    {
        if(isset($_SESSION['id']))
        {
            header("Location: http://".$_SERVER['HTTP_HOST'].'?page=summary');
            return;
        }
        if ($this->isPost())
        {
            $login = $_POST['login'] ? trim($_POST['login']) : '';
            $pass = $_POST['password'] ? trim($_POST['password']) : '';

            $repository = new UserRepository();

            $user = $repository->getUser($login);

            if(!$user)
            {
                $this->render('login', ['message'=>'Użytkownik o takim emailu nie istnieje']);
                return;
            }

            if(!password_verify($pass, $user->getPassword()))
            {
                $this->render('login', ['message'=>'Błędne hasło']);
                return;
            }

            $_SESSION['id'] = $user->getId();
            $_SESSION['login'] = $user->getLogin();
            $_SESSION['role'] = $user->getRole();

            $http = $_SERVER['HTTP_HOST'];
            header("Location: http://".$http."?page=summary");

            return;
        }
        $this->render('login');
    }

    public function register()
    {
        if(isset($_SESSION['id']))
        {
            header("Location: http://".$_SERVER['HTTP_HOST'].'?page=summary');
            return;
        }
        if($this->isPost())
        {
            $login = $_POST['login'] ? trim($_POST['login']) : '';
            $pass = $_POST['password'] ? trim($_POST['password']) : '';
            $pass2 = $_POST['password2'] ? trim($_POST['password2']) : '';

            if(strlen($login) <= 5)
            {
                $this->render('register',['message'=>'Podany email jest za krótki!']);
                return;
            }

            if(strlen($pass) <= 6)
            {
                $this->render('register',['message'=>'Podane hasło jest za krótkie']);
                return;
            }

            if($pass !== $pass2)
            {
                $this->render('register',['message'=>'Podane hasła nie są identyczne!']);
                return;
            }

            $repository = new UserRepository();
            $user = $repository->getUser($login);

            if($user !== null)
            {
                $this->render('register',['message'=>'Użytkownik o podanym emailu już istnieje!']);
                return;
            }

            //dodać regexpy
            $hash = password_hash($pass, PASSWORD_BCRYPT);

            $user = new User($login,$hash);


            if($repository->setUser($user))
                $this->render('login', ['message'=>'Poprawnie zarejestrowano użytkownika '.$login.". Możesz się zalogować"]);
            else
                $this->render('login', ['message'=>'Błąd przy rejestracji']);

            return;
        }

        $this->render('register');
    }

    public function reminder()
    {
        if(isset($_SESSION['id']))
        {
            header("Location: http://".$_SERVER['HTTP_HOST'].'?page=summary');
            return;
        }

        if($this->isPost())
        {
            $login = $_POST['login'] ? trim($_POST['login']) : '';
            $repository = new UserRepository();
            $user = $repository->getUser($login);

            if(!$user)
            {
                $this->render('reminder',['message'=>'Brak użytkownika o takim adresie']);
                return;
            }

            $this->render('reminder', ['message'=>'Na podany adres został wysłany mail z linkiem do resetowania hasła.']);
            return;
        }

        $this->render('reminder');
    }

    public function logout()
    {
        if($_SESSION['id']) {
            session_unset();
            session_destroy();

            $this->render('login', ['message' => 'Wylogowaleś się poprawnie']);
            return;
        }
        $http = $_SERVER['HTTP_HOST'];
        header("Location: http://".$http);
    }
}