<?php

require_once './database/dbConnection.php';

class loginModel
{
    private $nick;
    private $email;
    private $password;
    private $db;

    public function __construct($data)
    {
        $this->db = new dbConecction();
        $this->nick = $data['nick'];
        $this->email = $data['email'];
        $this->password = $data['password'];


    }

    public function checkUser(){
        try {
            $data = $this->db->connection();
            $sql = 'SELECT nick, email, password FROM users WHERE nick LIKE ? OR email LIKE ?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('ss', $this->nick, $this->email);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                
                if($this->checkPassword($data)){
                    $result = true;
                }
            } else {
                $result = false;
            }
            return $result;
        } catch (ErrorException $e) {
            $result = false;
            return $result;
        }
    }

    private function checkPassword($data){
        
        if ($data['password'] === $this->password){

            $_SESSION['password'] = $this->password;
            $_SESSION['email'] = $this->email;
            
        }
    }

}