<?php
require 'chaves/Handlers.php';

class Deposito extends Handlers
{

    public function __construct()
    {

    }
    public function findAllMeds()
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT id, nomecompleto FROM ti_clientes
         WHERE id_xpert > 0 AND loginName IS NOT NULL AND inativo = 0 
         ORDER BY loginName ");
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function findAll($FtipoData, $Fmed, $Fconta, $start, $resultadoPorPagina)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT  COUNT(*) AS resultados FROM (SELECT c.id AS id_reg, DATA,u.loginName, c.dinheiro, c.conta_dep AS conta, c.cheque, c.conta_depCh AS contaCh, 
        c.dinheiro + c.cheque AS ttdep, debito, c.datahoraReg 	
        FROM med_caixa AS c 
        LEFT JOIN ti_clientes AS u ON c.id_med = u.id
        WHERE c.id > 0 $Fmed $Fconta $FtipoData) AS SUB ");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);
    
        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start 
        c.id, 
        DATEFORMAT(c.data, 'DD-MM-YYYY') AS dataMovimento,
        c.data AS diaDaSemana,
        DATEFORMAT(c.datahoraReg , 'DD-MM-YYYY') AS dataRegistro,
        u.loginName, c.dinheiro, c.conta_dep AS conta, c.cheque, c.conta_depCh AS contaCh, 
        c.dinheiro + c.cheque AS ttdep, debito	
        FROM med_caixa AS c 
        LEFT JOIN ti_clientes AS u ON c.id_med = u.id
        WHERE c.id > 0 $Fmed $Fconta $FtipoData");
        if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
       
    }
    public function findById($id)
    {

        $data = [];
  
        $sql = $this->connection()->prepare("SELECT mc.id, mc.id_med, mc.data, DATEFORMAT(mc.datahoraReg, 'YYYY-MM-DD') AS datahoraReg, mc.dinheiro, mc.cheque, mc.debito, mc.conta_dep, tc.nomecompleto 
        FROM med_caixa AS mc
        LEFT JOIN ti_clientes AS tc
        ON tc.id = mc.id_med
        WHERE mc.id = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectObservacoes($id)
    {

        $data = [];
  
        $sql = $this->connection()->prepare("SELECT 
        DATEFORMAT(mo.datahora, 'DD-MM-YYYY HH:NN') AS datahora, mo.texto, 
        (CASE WHEN tc.nomecompleto = '' THEN 'USUARIO' ELSE tc.nomecompleto END) AS usuario
        FROM med_caixa_obs AS mo
        LEFT JOIN ti_clientes AS tc
        ON tc.id = mo.id_usuario
        WHERE mo.id_reg = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function insertDeposito($idUsuario, $dataDeposito, $dinheiro, $cheque, $debito, $conta, $contaCh)
    {
            
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO med_caixa 
        (id_med, data, dinheiro, cheque, datahoraReg, debito, conta_dep, conta_depCh) VALUES 
        (:idUser, :dataDeposito, :dinheiro, :cheque, :hoje, :debito, :conta, :contaCh)");
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('dataDeposito', $dataDeposito);
        $sql->bindValue('dinheiro', $dinheiro);
        $sql->bindValue('cheque', $cheque);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('debito', $debito);
        $sql->bindValue('conta', $conta);
        $sql->bindValue('contaCh', $contaCh);
        if($sql->execute()){

            return true;
        }    
     
    }
    public function insertObservacao($id, $idUsuario, $observacao)
    {
            
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO med_caixa_obs (id_reg, datahora, id_usuario, texto) 
        VALUES (:id, :hoje, :idUser, :obs)");
        $sql->bindValue('id', $id);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('obs', $observacao);

        if($sql->execute()){

            return true;
        }    
     
    }
    
}
