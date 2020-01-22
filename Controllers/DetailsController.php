<?php
require_once 'AppController.php';
require_once __DIR__.'/../Repositories/UserRepository.php';

class DetailsController extends AppController
{
    public function contact()
    {

        $this->render('contact');
    }

    public function userDetails()
    {
        if(!isset($_SESSION['id']))
        {
            $this->render('login',['message'=>'Zaloguj się aby zobaczyć tę stronę'],'SecurityController');
            return;
        }

        $repository = new UserRepository();
        $userDetails = $repository->getUserDetails($_SESSION['id']);
        $message ='';
        if($this->isPost())
        {
            $age = isset($_POST['age']) ? trim($_POST['age']) : '';
            $size = isset($_POST['size']) ? trim($_POST['size']) : '';
            $weight = isset($_POST['weight']) ? trim($_POST['weight']) : '';
            $male = isset($_POST['male']) ? trim($_POST['male']) : '';

            if($age == '' || $size == '' || $weight == '' || $male == '')
            {
                $message = "Uzupełnij wszystkie pola";
                goto a;
            }

            if(!is_numeric($age) || !is_numeric($size) || !is_numeric($weight) || !is_numeric($male) || $age < 3 || $size < 50 || $weight < 10)
            {
                $message = "Podane wartości nie są poprawne";
                goto a;
            }

            if($repository->updateUserDetails($age, $size, $weight, $male, $userDetails->getId()))
                $message = "Dane zaktualizowane";
            else
                $message = 'Błąd aktualizacji danych';

        }
        a:

        $userDetails = $repository->getUserDetails($_SESSION['id']);

        $rola = '';
        switch ($_SESSION['role'])
        {
            case 2:
                $rola = "Moderator";
                break;
            case 3:
                $rola = "Administrator";
                break;
            default:
                $rola = "Użytkownik";
        }

        $bmi = round($userDetails->getWeight()/$userDetails->getSize()/$userDetails->getSize()*10000,2);

        $this->render('user',['age'=>$userDetails->getAge(), 'size'=>$userDetails->getSize(), 'role'=>$rola, 'weight'=>$userDetails->getWeight(), 'male'=>$userDetails->getMale(), 'message'=>$message,'bmi'=>$bmi]);
    }
}