<?php
require 'chaves/Handlers.php';

class SolicitacaoDePagamento extends Handlers
{

    public function __construct()
    {

    }
    public function findLastIdAnexo(){

        $sql = $this->connection()->prepare("SELECT TOP 1 id_ccp_reqCompras_anexos FROM ccp_reqCompras_anexos ORDER BY id_ccp_reqCompras_anexos DESC"); 
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id_ccp_reqCompras_anexos'];
    }
    public function findLastId(){

        $sql = $this->connection()->prepare("SELECT TOP 1 id_ccp_reqCompras FROM ccp_reqCompras ORDER BY id_ccp_reqCompras DESC"); 
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id_ccp_reqCompras'];
    }
    public function findAll($Fstatus, $Fmed, $Ffornecedor, $Fdata, $start, $resultadoPorPagina)
    {
        $data = [];
       
        $sql = $this->connection()->prepare("SELECT COUNT(*) AS resultados FROM 
        (SELECT id_ccp_reqCompras AS idReq, r.fornecedor, r.med, c.id, c.apelido, r.descricao,
        CONVERT(char(10), r.valor, '%0.2f') as valor , 
        DATEFORMAT(r.vencimento, 'DD-MM-YYYY') AS vencimento, r.status, r.obs
		FROM ccp_reqCompras AS r
		LEFT JOIN ti_clientes AS c ON r.usuario = c.id
		WHERE id_ccp_reqCompras > 0 $Fdata $Fstatus $Fmed $Ffornecedor) AS SUB ");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);
        
        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start
        id_ccp_reqCompras AS idReq, r.fornecedor, r.med, c.id, c.apelido, r.descricao, CONVERT(char(10), r.valor, '%0.2f') as valor , DATEFORMAT(r.vencimento, 'DD-MM-YYYY') AS vencimento, r.status, r.obs
		FROM ccp_reqCompras AS r
		LEFT JOIN ti_clientes AS c ON r.usuario = c.id
		WHERE id_ccp_reqCompras > 0 $Fdata $Fstatus $Fmed $Ffornecedor
		ORDER BY id_ccp_reqCompras DESC");
       
       if ($sql->execute()) {

            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
  
        
    }
    public function findById($id)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT id_ccp_reqCompras AS idReq, r.fornecedor, r.med, c.id, c.apelido, r.descricao, CONVERT(char(10), r.valor, '%0.2f') as valor , DATEFORMAT(r.vencimento, 'DD-MM-YYYY') AS vencimento, r.status, r.obs
		FROM ccp_reqCompras AS r
		LEFT JOIN ti_clientes AS c ON r.usuario = c.id
		WHERE id_ccp_reqCompras > 0 AND id_ccp_reqCompras = :id ");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->converterUtf8($data);
    }
    public function selectAnexos($id)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT rca.id_ccp_reqCompras_anexos AS idAnexo, DATEFORMAT(rca.datahora, 'DD-MM-YYYY HH:NN') AS datahora, rca.usuario, rca.descricao, rca.extensao  
        FROM ccp_reqCompras_anexos  AS rca
        WHERE id_ccp_reqCompras = :id 
        ORDER BY rca.id_ccp_reqCompras_anexos DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->converterUtf8($data);
        
    }
    public function selectObservacao($id)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT DATEFORMAT(rco.datahora, 'DD-MM-YYYY HH:NN') AS datahora, rco.usuario, rco.obs
        FROM ccp_reqCompras_obs  AS rco
        WHERE id_ccp_reqCompras = :id 
        ORDER BY rco.id_ccp_reqCompras_obs DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->converterUtf8($data);

    }
    public function insertObservacao($id, $usuarioLogado, $observacao)
    {
        
        $hoje = date('Y-m-d H:i:s');
        $gerado = 'SISTEMA';
       
        $sql = $this->connection()->prepare("INSERT INTO ccp_reqCompras_obs (id_ccp_reqCompras, usuario, datahora, obs, gerado) 
        VALUES (:id, :usuario, :dataHr, :obs, :gerado)");
        $sql->bindValue('id', $id);
        $sql->bindValue('usuario', $usuarioLogado);
        $sql->bindValue('dataHr', $hoje);
        $sql->bindValue('obs', $observacao);
        $sql->bindValue('gerado', $gerado);
        $sql->execute();

        return true;

    }
    public function insertAnexo($descricao, $extensao, $id, $usuarioLogado)
    {
        
        $hoje = date('Y-m-d H:i:s');
       
        $sql = $this->connection()->prepare("INSERT INTO ccp_reqCompras_anexos 
        (descricao, datahora, extensao, id_ccp_reqCompras, usuario)
        VALUES 
        (:descr, :hoje, :ext , :id, :user)");
        $sql->bindValue('descr', $descricao);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('ext', $extensao);
        $sql->bindValue('id', $id);
        $sql->bindValue('user', $usuarioLogado);
        $sql->execute();

        return true;

    }
    public function updateStatus($id, $status)
    {

        $sql = $this->connection()->prepare("UPDATE ccp_reqCompras SET status = :stt WHERE id_ccp_reqCompras = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('stt', $status);
        $sql->execute();
        
        return true;
       
    }
    public function selectAllFornecedores($idXpert)
    {
        
        $sql = ("SELECT ID_ENTIDADE, NOMEENTIDADE FROM ENTIDADES WHERE ID_FILIAL = $idXpert AND ATIVO = 0 AND PESSOA = 1
        GROUP BY ID_ENTIDADE,NOMEENTIDADE
        ORDER BY NOMEENTIDADE");
        $qry = odbc_exec($this->connectionXpert(), $sql) or die('Erro: ' . odbc_errormsg());
        $fornecedores = array();
        while($row = odbc_fetch_array($qry)){
            
            $fornecedor = array(
                "id" => $row['ID_ENTIDADE'],
                "nome" => $row['NOMEENTIDADE']
            );
            $fornecedores[] = $fornecedor;
        }
        return $fornecedores;

    } 
}
