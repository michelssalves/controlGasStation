<?php

class Conexao
{

    private $dsn = 'odbc:SB-PEDIDOS';
    private $username = 'dba';
    private $password = 'rdp';
    private $conn;

    public function __construct()
    {
    
    }
    public function conectar(){

        try {

            $this->conn = new PDO($this->dsn, $this->username, $this->password);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;


    }
}


