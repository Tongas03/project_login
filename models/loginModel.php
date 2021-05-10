<?php

require_once './database/dbConnection.php';
require_once './controllers/sessionController.php';

class loginModel
{

    private $email;
    private $password;
    private $session;
    private $db;

    public function __construct()
    {
        $this->session = new sessionController;
        $this->db = new dbConecction();
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Buscar un Usuario en Base de Datos y comprobar datos
     */
    public function checkUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'SELECT email, password FROM users WHERE email LIKE ?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('s', $this->email);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                if ($this->checkPassword($data)) {
                    $response = [
                        'response' => true,
                        'data' => 'Redireccionando'
                    ];
                } else {
                    $response = [
                        'response' => false,
                        'data' => 'Contraseña no coincide o usuario inexistente'
                    ];
                }
            } else {
                $response = [
                    'response' => false,
                    'data' => 'No se pudo verficiar el usuario'
                ];
            }
            $stmt->close();
            return $response;
        } catch (ErrorException $e) {
            $response = [
                'response' => false,
                'data' => $e
            ];
            return $response;
        }
    }

    private function checkPassword($data)
    {
        if (isset($data)) {
            if (password_verify($this->password, $data['password'])) {

                $this->session::init();

                $this->session::createToken();

                return true;
            }
        } else {

            return false;
        }
    }
}
