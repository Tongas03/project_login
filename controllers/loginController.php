<?php

require_once './models/loginModel.php';

class loginController
{

    public function index(){

        require_once './resources/views/loginView.php';

    }

    public function checkLogin(){
            
        $data = $_POST;

        $login = new loginModel();

        $login->setEmail($data['email']);
        $login->setPassword($data['password']);

        $response = $login->checkUser();

        echo json_encode($response);


    }
    
}