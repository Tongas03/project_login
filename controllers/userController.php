<?php

require '../models/userModel.php';

class userController
{
    public function index()
    {
        require './resources/views/userView.php';
    }

    public function newUser($data){

        $user = new userModel($data);

        $user->setName($data['name']);
        $user->setSurname($data['surname']);
        $user->setEmail($data['email']);
        $user->setNick($data['nick']);
        $user->setPassword($data['password']);

        $response = $user->newUser();

        return $response;
    }

    public function downUser($data)
    {
        $user = new userModel($data);

        $user->setId($data['id']);

        $response = $user->downUser();

        return $response;
    }

    public function updateUser($data)
    {
        $user = new userModel($data);

        $user->setName($data['name']);
        $user->setSurname($data['surname']);
        $user->setEmail($data['email']);
        $user->setNick($data['nick']);
        $user->setPassword($data['password']);

        $response = $user->updateUser();

        return $response;
    }

    public function getUser($data)
    {
        $user = new userModel($data);

        $user->setId($data['id']);

        $response = $user->getOne();

        return $response;
    }

    public function getAllUsers(){

        $user = new userModel(null);

        $response = $user->getAll();

        return $response;

    }
}