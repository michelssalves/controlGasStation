<?php
require 'chaves/Handlers.php';

class CaixaDiario extends Handlers
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
    public function findLastIdAnexo(){

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM ccp_fechamentoCaixa_anexo ORDER BY id DESC"); 
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id'];
    }
    public function findLastId(){

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM ccp_fechamentoCaixa ORDER BY id DESC"); 
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id'];
    }
    public function findAll($filtroStatus, $filtroFilial, $filtroData, $filtroTurno, $filtroConciliacao, $start, $resultadoPorPagina)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT  COUNT(*) AS resultados FROM (SELECT FLOOR(ISNULL(f.dep_dinheiro,0) + ISNULL(f.pix,0) + ISNULL(f.dep_brinks,0) + ISNULL(f.dep_cheque,0)) AS soma , 
        f.id AS id_requisicao, isnull(f.fechaCaixa, '') AS caixa, u.loginName, 
        CASE WHEN f.obs = '' THEN 'NÃO' ELSE 'SIM' END AS obs,
        CASE WHEN f.concBancaria = 'SIM' THEN f.concBancaria ELSE 'NAO' END AS conc,
        f.status, f.data_caixa, f.dep_dinheiro, f.dep_cheque, 
        f.dep_brinks, f.pix, f.turnos_definitivo
        FROM ccp_fechamentoCaixa AS f
        JOIN ti_clientes AS u ON f.id_med = u.id
        WHERE f.id > 0
        $filtroData $filtroStatus $filtroFilial $filtroTurno $filtroConciliacao) AS SUB ");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);
    
        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start 
        FLOOR(ISNULL(f.dep_dinheiro,0) + ISNULL(f.pix,0) + ISNULL(f.dep_brinks,0) + ISNULL(f.dep_cheque,0)) AS soma , 
        f.id AS id_requisicao, isnull(f.fechaCaixa, '') AS caixa, u.loginName, 
        CASE WHEN f.obs = '' THEN 'NÃO' ELSE 'SIM' END AS obs,
        CASE WHEN f.concBancaria = 'SIM' THEN f.concBancaria ELSE 'NAO' END AS conc,
        f.status, f.data_caixa, f.dep_dinheiro, f.dep_cheque, 
        f.dep_brinks, f.pix, f.turnos_definitivo
        FROM ccp_fechamentoCaixa AS f
        JOIN ti_clientes AS u ON f.id_med = u.id
        WHERE f.id > 0
        $filtroData $filtroStatus $filtroFilial $filtroTurno $filtroConciliacao ORDER BY f.id DESC");
        if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
       
    }
    public function findById($id)
    {

        $data = [];
  
        $sql = $this->connection()->prepare("SELECT isnull(concBancaria, '') AS conc, isnull(f.fechaCaixa, '') AS caixa, u.id AS id_user, 
        u.loginName, u.controladorMed, f.id AS id_requisicao, f.obs, f.status, f.data_caixa, f.dep_dinheiro, f.dep_cheque, 
        f.dep_brinks, f.pix, f.turnos_definitivo, f.id_med
        FROM ccp_fechamentoCaixa AS f
        JOIN ti_clientes AS u ON f.id_med = u.id
        WHERE f.id > 0  AND f.id = :id 
        ORDER BY f.data_caixa ASC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectAnexos($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT  id, descricao, extensao, DATEFORMAT(dthr_anexo, 'DD-MM-YYYY HH:MM') AS dthr_anexo  FROM ccp_fechamentoCaixa_anexo 
        WHERE id_requisicao = :id AND excluir IS NULL");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectEventos($id)
    {
        $data = [];

        $sql = $this->connection()->prepare("SELECT usuario, obs, gerado, DATEFORMAT(datahora, 'DD-MM-YYYY- HH:MM') AS datahora 
        FROM ccp_fechamentoCaixa_obs 
        WHERE id_requisicao = :id ORDER BY datahora DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function insertFechamento($dinheiro, $cheque, $brinks, $pix, $dataCaixa, $turnos_definitivo, $obs, $idUsuario)
    {
        $status = 'NOVO';
        $conciliacao = NULL;
        $fechaCaixa = NULL;

        $sql = $this->connection()->prepare("INSERT INTO ccp_fechamentoCaixa 
        (dep_dinheiro, dep_cheque, dep_brinks, data_caixa, turnos_definitivo, obs, status, id_med, concBancaria, fechaCaixa, pix) VALUES 
        (:dinheiro, :cheque, :brinks, :dataCx, :turno, :obs, :stt, :idUser, :conc, :fecCx, :pix)");
        $sql->bindValue('dinheiro', $dinheiro);
        $sql->bindValue('cheque', $cheque);
        $sql->bindValue('brinks', $brinks);
        $sql->bindValue('dataCx', $dataCaixa);
        $sql->bindValue('turno', $turnos_definitivo);
        $sql->bindValue('obs', $obs);
        $sql->bindValue('stt', $status);
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('conc', $conciliacao);
        $sql->bindValue('fecCx', $fechaCaixa);
        $sql->bindValue('pix', $pix);
        $sql->execute();
      
        return true;
    }
    public function insertAnexo($id, $descricao, $extensao)
    {
        $hoje = date('Y-m-d H:i:s');
        $excluir = '0';

        $sql = $this->connection()->prepare("INSERT INTO ccp_fechamentoCaixa_anexo 
        (id_requisicao, descricao, extensao, dthr_anexo, excluir) 
        VALUES (:id, :descricao , :ext, :dataHr, :excluir)");
        $sql->bindValue('id', $id);
        $sql->bindValue('descricao', $descricao);
        $sql->bindValue('ext', $extensao);
        $sql->bindValue('dataHr', $hoje);
        $sql->bindValue('excluir', $excluir);
        $sql->execute();
        return true;
    }
    public function insertObservacoes($id, $usuarioLogado, $obs)
    {

        $hoje = date('Y-m-d H:i:s');
        $quemAlterou = "USUARIO";

        $sql = $this->connection()->prepare("INSERT INTO ccp_fechamentoCaixa_obs 
        (id_requisicao, datahora, usuario, obs, gerado) 
        VALUES 
        (:id, :dataHr, :usuarioLogado, :obs, :gerado)");
        $sql->bindValue('id', $id);
        $sql->bindValue('dataHr', $hoje);
        $sql->bindValue('usuarioLogado', $usuarioLogado);
        $sql->bindValue('obs', $obs);
        $sql->bindValue('gerado', $quemAlterou);
        $sql->execute();

        return true;
    }
    public function updateCaixa($id, $dinheiro, $cheque, $brinks,  $pix, $med, $data, $definitivo, $conciliacao = '', $fechamento, $observacao)
    {

        $sql = $this->connection()->prepare("UPDATE ccp_fechamentoCaixa 
        SET dep_dinheiro = :dinh, dep_cheque = :chq, dep_brinks = :brinks,
        pix = :pix, id_med = ':med, data_caixa = :dataHr, turnos_definitivo = :def,
        concBancaria = :conc, fechaCaixa = :fech, obs = :obs
        WHERE id = :id ");
         $sql->bindValue('id', $id);
         $sql->bindValue('dinh', $dinheiro);
         $sql->bindValue('chq', $cheque);
         $sql->bindValue('brinks', $brinks);
         $sql->bindValue('pix', $pix);
         $sql->bindValue('med', $med);
         $sql->bindValue('dataHr', $data);
         $sql->bindValue('def', $definitivo);
         $sql->bindValue('conc', $conciliacao);
         $sql->bindValue('fech', $fechamento);
         $sql->bindValue('obs', $observacao);

        $sql->execute();

        return true;
    }
    public function updateCancelarCaixa($id, $status, $observacao)
    {

        $sql = $this->connection()->prepare("UPDATE ccp_fechamentoCaixa 
        SET status = :stt, obs = :obs WHERE id = :id ");
        $sql->bindValue('id', $id);
        $sql->bindValue('stt', $status);
        $sql->bindValue('obs', $observacao);

        $sql->execute();

        return true;
    }
  
    

}
