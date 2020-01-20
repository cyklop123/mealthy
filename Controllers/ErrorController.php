<?php
require_once "AppController.php";

class ErrorController extends AppController
{
    public function error()
    {
        $this->render('error');
    }
}