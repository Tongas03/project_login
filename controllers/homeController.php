<?php

require_once './controllers/sessionController.php';

class homeController
{
    private $session;

    public function __construct()
    {
        $this->session = new sessionController();
    }

    public function index()
    {
        $this->session::init();

        if(isset($_SESSION['token'])){

            require_once './resources/views/homeView.php';
        } 
        else {

            $this->session::finish();

            header('Location: /login/index');
        }
            
    }

}
