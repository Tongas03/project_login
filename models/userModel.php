<?php

require_once './database/dbConnection.php';

class userModel
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $db;

    /**
     * Constructor
     * @param $data
     */
    public function __construct()
    {
        $this->db = new dbConecction;
    }

    // ============================
    //  Getters and Setters
    // ============================

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
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
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        return $this;
    }

    // ============================
    //  Methods
    // ============================

    /**
     * Anadir o Registrar un Usuario a Base de Datos
     */
    public function addUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'INSERT INTO users (name, surname, email, password) VALUES (?,?,?,?)';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('ssss', $this->name, $this->surname, $this->email, $this->password);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $result = [
                    'response' => true,
                    'data' => 'El usuario se registró con exito'
                ];
            } else {
                $result = [
                    'response' => false,
                    'data' => 'Hubo problemas en el registro, intente de nuevo'
                ];
            }
            $stmt->close();
            return $result;
        } catch (ErrorException $e) {
            $result = [
                'response' => false,
                'data' => $e
            ];
            return $result;
        }
    }

    /**
     * Actualizar un Usuario de Base de datos por ID
     */
    public function updateUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'UPDATE users SET name=?, surname=?, email=? WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('sssi', $this->name, $this->surname, $this->email, $this->id);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $response = [
                    'response' => true,
                    'data' => 'El usuario se modificó con exito'
                ];
            } else {
                $response = [
                    'response' => false,
                    'data' => 'No se pudo moficar el usuario'
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

    /**
     * ELiminar un Usuario de Base de Datos por ID
     */
    public function downUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'DELETE FROM users WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $response = [
                    'response' => true,
                    'data' => 'Se dió de baja el usuario'
                ];
            } else {
                $response = [
                    'response' => false,
                    'data' => 'No se dió de baja el usuario'
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

    /**
     * Extraer un Usuarios de Base de Datos por ID
     */
    public function getOne()
    {
        try {
            $data = $this->db->connection();
            $sql = 'SELECT id, name, surname, email FROM users WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('i', $this->id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $response = [
                    'response' => true,
                    'data' => $data
                ];
            } else {
                $response = [
                    'response' => false,
                    'data' => 'No se puede mostrar el usuario'
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

    /**
     * Extraer todos los usuarios de Base de Datos
     */
    public function getAll()
    {
        try {
            $data = $this->db->connection();
            $sql = 'SELECT id, name, surname, email FROM users';
            $stmt = $data->prepare($sql);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_all();
                $response = [
                    'response' => true,
                    'data' => $data
                ];
            } else {
                $response = [
                    'response' => false,
                    'data' => 'No se puede mostrar los usuarios'
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
}
