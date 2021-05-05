<?php

require_once '../database/dbConnection.php';

class userModel
{
    protected $id;
    protected $name;
    protected $surname;
    protected $nick;
    protected $email;
    protected $password;
    protected $db;

    /**
     * Constructor
     * @param $data
     */
    public function __construct($data)
    {
        $this->db = new dbConecction;
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setSurname($data['surname']);
        $this->setNick($data['nick']);
        $this->setEmail($data['email']);
        $this->setPassword($data['password']);
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
     * Get the value of nick
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set the value of nick
     *
     * @return  self
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

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
     * Add New User
     */
    public function newUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'INSERT INTO users (name, surname, nick, email, password) VALUES (?,?,?,?,?,?)';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('ssssss', $this->getName(), $this->getSurname(), $this->getNick(), $this->getEmail(), $this->getPassword());
            if ($stmt->execute()) {
                $result = [
                    'response' => true
                ];
            } else {
                $result = [
                    'response' => false
                ];
            }
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
     * Update an User
     */
    public function updateUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'UPDATE users SET name=?, surname=?, nick=?, email=?, password=? WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('issssss', $this->getId(), $this->getName(), $this->getSurname(), $this->getNick(), $this->getEmail(), $this->getPassword());
            if ($stmt->execute()) {
                $response = [
                    'response' => true
                ];
            } else {
                $response = [
                    'response' => false
                ];
            }
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
     * Delete an User
     */
    public function downUser()
    {
        try {
            $data = $this->db->connection();
            $sql = 'DELETE FROM users WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('i', $this->getId());
            if ($stmt->execute()) {
                $response = [
                    'response' => true
                ];
            } else {
                $response = [
                    'response' => false
                ];
            }
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
     * Get One User
     */
    public function getOne()
    {
        try {
            $data = $this->db->connection();
            $sql = 'SELECT * FROM users WHERE id=?';
            $stmt = $data->prepare($sql);
            $stmt->bind_param('i', $this->getId());
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $response = [
                    'response' => true,
                    'data' => $data
                ];
            } else {
                $response = [
                    'response' => false
                ];
            }
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
     * Get All Users
     */
    public function getAll()
    {
        try {
            $data = $this->db->connection();
            $sql = 'SELECT * FROM users';
            $stmt = $data->prepare($sql);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $response = [
                    'response' => true,
                    'data' => $data
                ];
            } else {
                $response = [
                    'response' => false
                ];
            }
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
