<?php
require_once 'AppController.php';

class DetailsController extends AppController
{
    public function contact()
    {

        $this->render('contact');
    }

    public function userDetails()
    {

        $this->render('user');
    }
}