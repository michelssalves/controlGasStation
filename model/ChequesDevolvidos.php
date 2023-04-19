<?php
require 'chaves/Handlers.php';

class ChequeDevolvido extends Handlers
{

    public function __construct()
    {
   
    }
    public function findAll($FtipoData, $Fmed, $Fstatus, $start, $resultadoPorPagina)
    {

        $data = [];

         $sql = $this->connection()->prepare("SELECT  COUNT(*) AS resultados FROM (SELECT ch.id, ch.bco, SUBSTRING(ch.nome, 1, 15) AS nome , ch.nome AS nomeCliente, ch.nrcheque, ch.motivo, ch.cpfcnpj, u.loginName, ch.status,  
        NOW() as hoje, hoje - ch.dtDevol AS dias,
        DATEFORMAT(ch.ultimaAlteracao, 'DD-MM-YYYY') AS ultimaAlteracao, 
        DATEFORMAT(ch.dtDevol, 'DD-MM-YYYY') AS dataDevolucao,
        DATEFORMAT(ch.dtCheque, 'DD-MM-YYYY') AS dtCheque,
        DATEFORMAT(ch.dthrInclusao, 'DD-MM-YYYY') AS dthrInclusao,
        DATEFORMAT(ch.dtQuitacao, 'DD-MM-YYYY') AS dtQuitacao,
        ch.valor AS valor,
        valor + (valor * 0.001 * dias) AS valorCorr
        FROM ccp_chequeDev AS ch 
        LEFT JOIN ti_clientes AS u ON ch.id_med = u.id 
        WHERE ch.id > 0 $FtipoData $Fmed $Fstatus) AS SUB ");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);
    
        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start 
        ch.id, ch.bco, SUBSTRING(ch.nome, 1, 15) AS nome, ch.nome AS nomeCliente, ch.nrcheque, ch.motivo, ch.cpfcnpj, u.loginName, ch.status,
        NOW() as hoje, hoje - ch.dtDevol AS dias,
        DATEFORMAT(ch.ultimaAlteracao, 'DD-MM-YYYY') AS ultimaAlteracao, 
        DATEFORMAT(ch.dtDevol, 'DD-MM-YYYY') AS dataDevolucao,
        DATEFORMAT(ch.dtCheque, 'DD-MM-YYYY') AS dtCheque,
        DATEFORMAT(ch.dthrInclusao, 'DD-MM-YYYY') AS dthrInclusao,
        DATEFORMAT(ch.dtQuitacao, 'DD-MM-YYYY') AS dtQuitacao,
        ch.valor AS valor,
        valor + (valor * 0.001 * dias) AS valorCorr
        FROM ccp_chequeDev AS ch 
        LEFT JOIN ti_clientes AS u ON ch.id_med = u.id 
        WHERE ch.id > 0  $FtipoData $Fmed $Fstatus
        ORDER BY ch.id DESC");
        if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
  
       
    }
    public function findbyId($id)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT 
        ch.id, cb.banco, SUBSTRING(ch.nome, 1, 15) AS nome, ch.nome AS nomeCliente, ch.nrcheque, cm.motivo, ch.cpfcnpj, u.loginName, ch.status,
        NOW() as hoje, hoje - ch.dtDevol AS dias,
       ch.ultimaAlteracao,
       ch.dtDevol,
       ch.dtCheque, 
       ch.dthrInclusao,
       ch.dtQuitacao, 
        ch.valor AS valor,
        valor + (valor * 0.001 * dias) AS valorCorr
        FROM ccp_chequeDev AS ch 
        LEFT JOIN ti_clientes AS u ON ch.id_med = u.id 
        LEFT JOIN ccp_motivos AS cm ON cm.codigo = ch.motivo
        LEFT JOIN ccp_bancos AS cb ON cb.codigo = ch.bco 
        WHERE ch.id = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
  
       
    }
    public function selectObservacaoes($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT DATEFORMAT(co.datahora, 'DD-MM-YYYY HH:MM') AS datahora, co.usuario, co.obs  
        FROM ccp_chequeDevObs AS co
        WHERE co.id_cheque = :id ORDER BY co.id DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectAnexos($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT ca.id AS idAnexo, DATEFORMAT(ca.datahora, 'DD-MM-YYYY HH:MM') AS datahora, 
        ca.usuario, ca.descricao, ca.tipo
        FROM ccp_chequeDevAnexo AS ca
        WHERE ca.id_cheque = :id ORDER BY ca.id DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectEventos($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT DATEFORMAT(ce.dthrEvento, 'DD-MM-YYYY HH:MM') AS datahora, 
        ce.usuario, ce.evento
        FROM ccp_chequeDevEventos AS ce
        WHERE ce.id_cheque = :id ORDER BY ce.id DESC ");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function insertAnexo($descricao, $extensao, $id, $idUsuario, $usuarioLogado)
    {
            $hoje = date('Y-m-d H:i:s');

            $sql = $this->connection()->prepare("INSERT INTO ccp_chequeDevAnexo (descricao, tipo, id_cheque, datahora, id_usuario, usuario) 
            VALUES (:descr, :ext, :id, :hoje, :idUser, :user)");
            $sql->bindValue('descr', $descricao);
            $sql->bindValue('ext', $extensao);
            $sql->bindValue('id', $id);
            $sql->bindValue('hoje', $hoje);
            $sql->bindValue('idUser', $idUsuario);
            $sql->bindValue('user', $usuarioLogado);
            if($sql->execute()){
                
                return true;
            }  
       
    }
    public function insertEvento($evento, $id, $idUsuario, $usuarioLogado)
    {

        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO ccp_chequeDevEventos (id_cheque, idUsuario, usuario, dthrEvento, evento) 
        VALUES (:id, :idUser, :user, :hoje, :evento)");
        $sql->bindValue('id', $id);
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('user', $usuarioLogado);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('evento', $evento);
        if($sql->execute()){
            
            return true;
        }  
    
 
    }
    public function insertObservacao($id, $idUsuario, $usuarioLogado, $observacao)
    {
            
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO ccp_chequeDevObs (id_cheque, id_usuario, usuario, datahora, obs) 
        VALUES (:id, :idUser, :user, :hoje, :obs)");
        $sql->bindValue('id', $id);
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('user', $usuarioLogado);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('obs', $observacao);
        if($sql->execute()){

            return true;
        }    
     
    }
    public function updateUltimaAlteracao($id)
    {
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("UPDATE ccp_chequeDev SET ultimaAlteracao = :hoje WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('hoje', $hoje);
        $sql->execute();

        return true;
       
    }
    public function updateDataQuitacao($id, $status)
    {
        $hoje1 = date('Y-m-d');
        $hoje2 = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("UPDATE ccp_chequeDev SET dtQuitacao = :hoje1, ultimaAlteracao = :hoje2, status = :stt WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('hoje1', $hoje1);
        $sql->bindValue('hoje2', $hoje2);
        $sql->bindValue('stt', $status);
        $sql->execute();

        return true;
       
    }
    public function updateStatus($id, $status){

        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("UPDATE ccp_chequeDev SET dtQuitacao = NULL, ultimaAlteracao = :hoje, status = :stt WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('stt', $status);
        $sql->execute();

        return true;

    }

}
