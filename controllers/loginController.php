<?php

require './models/loginModel.php';

class loginController
{
    public function index(){
        require './resources/views/loginView.php';
    }

    public function checkLogin($data){
        $login = new loginModel($data);
    }
}

// require './resources/views/loginView.php';