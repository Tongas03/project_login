<?php

class dbConecction
{
    protected $host;
    protected $username;
    protected $password;
    protected $schema;
    protected $port;

    public function __construct()
    {
        $connection = file_get_contents('../database/connection.ini');

        if (!$setting = parse_ini_string($connection, true)) {
            throw new exception('No se puede abrir el archivo ' . $connection . '.');
        }

        $this->host = $setting["database"]["host"];
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
                echo "FALLO EN CONEXION A BASE DE DATOS: " . mysqli_connect_error();
            } else {
                $connection->query("SET NAMES 'utf8'");
                return $connection;
            }
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
