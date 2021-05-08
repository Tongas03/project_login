<?php

require_once './models/userModel.php';

class registerController
{

    public function index()
    {
        require_once './resources/views/registerView.php';
    }

    public function newUser()
    {

        $data = $_POST;

        $user = new userModel();

        $user->setName($data['name']);
        $user->setSurname($data['surname']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $response = $user->addUser();

        echo json_encode($response);
    }
}
