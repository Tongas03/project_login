<?php

class dbConecction
{
    private $host;
    private $username;
    private $password;
    private $schema;
    private $port;

    public function __construct()
    {
        $connection = file_get_contents('./config/connection.ini');

        if (!$setting = parse_ini_string($connection, true)) {
            $response = [
                'data' => 'No se puede abrir el archivo ' . $connection . '.'
            ];
            return $response;
        }

        $this->host =$setting["database"]["host"] ;
        $this->port = $setting["database"]["port"];
        $this->schema = $setting["database"]["schema"];
        $this->username = $setting["database"]["username"];
        $this->password = $setting["database"]["password"];
    }

    public function connection()
    {
        try {

            $connection = new mysqli($this->host, $this->username, $this->password, $this->schema, $this->port);
            if ($connection->errno) {
                $response = [
                    'data' => 'FALLO EN CONEXION A BASE DE DATOS: ' . mysqli_connect_error()
                ];
                return $response;
            } else {
                $connection->query("SET NAMES 'utf8'");
                return $connection;
            }
        } catch (ErrorException $e) {
            $response = [
                'data' => $e
            ];
            return $response;
        }
    }
}
