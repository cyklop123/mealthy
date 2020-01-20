<?php
require_once 'AppController.php';

class MainController extends AppController
{
    public function summary()
    {
        $this->render('summary');
    }
}