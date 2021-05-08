<?php

require_once './models/userModel.php';
require_once './controllers/sessionController.php';

class userController
{
    private $session;

    public function __construct()
    {
        $this->session = new sessionController();
    }

    public function index()
    {
        $this->session::init();

        if (isset($_SESSION['token'])) {
            var_dump($_SESSION);
            require_once './resources/views/userView.php';
        } else {
            $this->session::finish();
        }
    }

    public function downUser()
    {
        $data = $_POST;

        $user = new userModel();

        $user->setId($data['id']);

        $response = $user->downUser();

        echo json_encode($response);
    }

    public function updateUser()
    {
        $data = $_POST;

        $user = new userModel();

        $user->setName($data['name']);
        $user->setSurname($data['surname']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $response = $user->updateUser();

        echo json_encode($response);
    }

    public function getUser()
    {
        $data = $_POST;

        $user = new userModel();

        $user->setId($data['id']);

        $response = $user->getOne();

        echo json_encode($response);
    }

    public function getAllUsers(){

        $user = new userModel(null);

        $response = $user->getAll();

        echo json_encode($response);

    }
}