<?php

// require_once '../database/dbConnection.php';

class userController 
{
    private $id;
    private $role;
    private $name;
    private $surname;
    private $nick;
    private $email;
    private $password;
    private $image;
    private $token;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->role = $data['role'];
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->nick = $data['nick'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->image = $data['image'];
        $this->token = $data['token'];
    }

    public function index(){
        echo 'Controller User';
    }

    public function insert(){
        try {
            $db = new dbConecction();
            $data = $db->connection();
            $sql = 'INSERT INTO users (role, name, surname, nick, email, password, image, token) VALUES (?,?,?,?,?,?,?,?)';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('ssssssss', $this->role, $this->name, $this->surname, $this->nick, $this->email, $this->password, $this->image, $this->token);
            if($stmt->execute()){
                $result = true;
            } else {
                $result = false;
            }
            return $result;
        } catch (ErrorException $e) {
            $result = false;
            return $result;
        }
    }

    public function update(){
        try {
            $db = new dbConecction();
            $data = $db->connection();
            $sql = 'UPDATE users SET role=?, name=?, surname=?, nick=?, email=?, password=?, image=?, token=? WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('issssssss', $this->id, $this->role, $this->name, $this->surname, $this->nick, $this->email, $this->password, $this->image, $this->token);
            if ($stmt->execute()) {
                $result = true;
            } else {
                $result = false;
            }
            return $result;
        } catch (ErrorException $e) {
            $result = false;
            return $result;
        }
    }

    public function delete(){
        try {
            $db = new dbConecction();
            $data = $db->connection();
            $sql = 'DELETE FROM users WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('i', $this->id);
            if ($stmt->execute()) {
                $result = true;
            } else {
                $result = false;
            }
            return $result;
        } catch (ErrorException $e) {
            $result = false;
            return $result;
        }
    }

    public function getOne(){
        try {
            $db = new dbConecction();
            $data = $db->connection();
            $sql = 'SELECT * FROM users WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('i', $this->id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                return $data;
            } else {
                $result = false;
            }
            return $result;
        } catch (ErrorException $e) {
            $result = false;
            return $result;
        }
    }

    public function getAll(){
        try {
            $db = new dbConecction();
            $data = $db->connection();
            $sql = 'SELECT * FROM users';
            $stmt = $data->prepare($sql);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                return $data;
            } else {
                $result = false;
            }
            return $result;
        } catch (ErrorException $e) {
            $result = false;
            return $result;
        }
    }
}