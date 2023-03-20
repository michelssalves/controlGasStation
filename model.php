<?php
require 'conect.php';
$conn = new Conexao();

var_dump($conn);
/*
class Model
{
    private $conn;

    public function __construct()
    {   
       $this->conn = new Conexao();
    }
public function findAllMeds()
    {

       // $this->conn = new Conexao();

        $data = [];
        $sql = $this->conn->conectar()->prepare("SELECT id, nomecompleto FROM ti_clientes
         WHERE id_xpert > 0 AND loginName IS NOT NULL AND inativo = 0 
         ORDER BY loginName ");
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
}