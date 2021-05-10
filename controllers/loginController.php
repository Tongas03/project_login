<?php

require_once './models/loginModel.php';
require_once './controllers/sessionController.php';

class loginController
{
    private $session;

    public function __construct()
    {
        $this->session = new sessionController();
    }

    public function index(){

        if(isset($_SESSION)){
            
            $this->session::finish();
        }
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