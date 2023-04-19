<?php
require 'chaves/Handlers.php';

class Serasa extends Handlers
{

    public function __construct()
    {
        
        
    }
    public function findAll($Fstatus, $Fmatriz, $Fmed, $Ftipo, $Fcliente, $start, $resultadoPorPagina)
    {
        $data = [];

        $sql = $this->connection()->prepare("SELECT  COUNT(*) AS resultados FROM (SELECT 
        u.id, u.loginName, f.tipo, f.nomeCliente, f.valor, f.dataEmissao, f.dataVencimento, f.id_requisicao,
        (CASE WHEN f.matriz = 1 THEN 'SIM' ELSE 'NÃO' END) AS ematriz 
        FROM ccp_serasa AS f
        JOIN rh_usuario AS u ON f.id_med = u.id
        WHERE id_requisicao > 0  $Fstatus $Fmatriz $Fmed $Ftipo $Fcliente) AS SUB ");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);
   
        
        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start 
        u.id, u.loginName, f.tipo, f.nomeCliente, f.valor, f.dataEmissao, f.dataVencimento, f.id_requisicao,
        (CASE WHEN f.matriz = 1 THEN 'SIM' ELSE 'NÃO' END) AS ematriz 
        FROM ccp_serasa AS f
        JOIN rh_usuario AS u ON f.id_med = u.id
        WHERE id_requisicao > 0  $Fstatus $Fmatriz $Fmed $Ftipo $Fcliente ORDER  BY f.id_requisicao DESC ");
        if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function findById($id)
    {
        
        $data = [];
        $sql = $this->connection()->prepare("SELECT 
        f.id_requisicao, f.status, f.tipo, f.nomeCliente, f.cidade, f.bairro,
        f.cep,f.endereco, f.numero, f.dataNascimento,  f.cnpj, f.valor, f.valorjuros, 
        f.dataEmissao, f.dataVencimento,f.obs
        FROM ccp_serasa AS f
        WHERE id_requisicao = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function insertAnexo($id, $descricaoAnexo, $descricao, $extensao)
    {

        $sql = $this->connection()->prepare("INSERT INTO ccp_serasa_anexo (id_requisicao,  descricao, numDoc, extensao)
        VALUES (:id, :descricaoAnexo, :descricao, :extensao)");
        $sql->bindValue('id', $id);
        $sql->bindValue('descricaoAnexo', $descricaoAnexo);
        $sql->bindValue('descricao', $descricao);
        $sql->bindValue('extensao', $extensao);
        $sql->execute();
        return true;
    }
    public function insertEventos($id, $evento, $usuarioLogado)
    {
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO ccp_serasa_eventos (id_requisicao, evento, usuario, datahora)
        VALUES (:id, :evento , :usuario, :dataHr)");
        $sql->bindValue('id', $id);
        $sql->bindValue('evento', $evento);
        $sql->bindValue('usuario', $usuarioLogado);
        $sql->bindValue('dataHr', $hoje);
        $sql->execute();

        return true;
    }
    public function insertObservacao($id, $usuarioLogado, $observacao)
    {
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO ccp_serasa_obs (id_requisicao, datahora, usuario, obs) 
        VALUES ( :id, :dataHr, :usuario, :obs)");
        $sql->bindValue('id', $id);
        $sql->bindValue('dataHr', $hoje);
        $sql->bindValue('usuario', $usuarioLogado);
        $sql->bindValue('obs', $observacao);
        $sql->execute();

        return true;
    }
    public function selectAnexos($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT id, descricao, numDoc, extensao FROM ccp_serasa_anexo
        WHERE id_requisicao = :id ");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectEventos($id)
    {
        $data = [];

        $sql = $this->connection()->prepare("SELECT DATEFORMAT(datahora, 'DD-MM-YYYY- HH:MM') AS datahora , usuario, evento 
        FROM ccp_serasa_eventos WHERE id_requisicao = :id 
        ORDER BY id DESC
        ");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectObservacoes($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT DATEFORMAT(datahora, 'DD-MM-YYYY- HH:MM') AS datahora, usuario, obs 
        FROM ccp_serasa_obs WHERE id_requisicao = :id
        ORDER BY id DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return $data;
    }
    public function updateStatus($id, $status)
    {
        
        $sql = $this->connection()->prepare("UPDATE ccp_serasa SET status = :stt WHERE id_requisicao = :id");
        $sql->bindValue('stt', $status);
        $sql->bindValue('id', $id);
        $sql->execute();
          
        return true;
    }
    public function updateSerasa($id, $dtNascimento, $dtEmissao ,$dtVencimento, $tipo, $valorInicial, $valorJuros){

            $sql = $this->connection()->prepare("UPDATE ccp_serasa SET 
            dataNascimento = :dtNascimento, 
            dataEmissao = :dtEmissao ,
            dataVencimento = :dtVencimento, 
            tipo = :tipo, 
            valor = :valorInicial, 
            valorJuros = :valorJuros
           
            WHERE id_requisicao = :id");
            $sql->bindValue('id', $id);
            $sql->bindValue('dtNascimento', $dtNascimento);
            $sql->bindValue('dtEmissao', $dtEmissao);
            $sql->bindValue('dtVencimento', $dtVencimento);
            $sql->bindValue('tipo', $tipo);
            $sql->bindValue('valorInicial', $valorInicial);
            $sql->bindValue('valorJuros', $valorJuros);
            $sql->execute();
          
            return true;

        }
}

