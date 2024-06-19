<?php

class Conectar
{

    private $driver = "mysql";
    private $host = "localhost";
    private $port = "3307";
    private $user = "root";
    private $pass = "";
    private $database = "crudAlimentos";
    private $charset = "utf8mb4";

    public function __construct()
    { }

    public function conexion()
    {

        if ($this->driver == "mysql" || $this->driver == null) {
            $con = new mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->query("SET NAMES '" . $this->charset . "'");
        }

        return $con;
    }

    public function conexionPDO()
    {

        $pdo = null;
        if ($this->driver == "mysql" || $this->driver == null) {
            try {
                 $pdo = new PDO(
                    'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->database . '',
                    $this->user,
                    $this->pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }

        return $pdo;
    }
}