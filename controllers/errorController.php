<?php

require_once './controllers/sessionController.php';

class errorController
{

    public function index(){
        
        if (isset($_SESSION)){
            session_destroy();
        }

        require_once './resources/views/errorView.php';
    }
}