<?php

require_once './controllers/sessionController.php';

class errorController
{
    private $session;

    public function __construct()
    {
        $this->session = new sessionController();
    }

    public function index(){

        $this->session::finish();

        require_once './resources/views/errorView.php';
    }
}