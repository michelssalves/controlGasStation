<?php
require 'chaves/Handlers.php';

class CadastroCliente extends Handlers
{

    public function __construct()
    {

    }
    public function findLastIdAnexo()
    {

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM med_cliente_documento ORDER BY id DESC");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id'];
    }
    public function findLastId()
    {

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM med_cliente ORDER BY id DESC");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id'];
    }
    public function findAll($FStatus, $FFilial, $FData, $start, $resultadoPorPagina)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT  COUNT(*) AS resultados FROM (SELECT c.id AS Id, data_cadastro, c.idXpert, loginName, c.RazaoSocial, c.cidade, c.status, 
			(SELECT TOP 1 datahora FROM med_cliente_evento AS e WHERE e.id_cliente = c.id ORDER BY e.datahora DESC) AS dtevento,
			(SELECT TOP 1 usuario FROM med_cliente_evento AS e WHERE e.id_cliente = c.id ORDER BY e.datahora DESC) AS usuario,
			(SELECT TOP 1 obs FROM med_cliente_evento AS e WHERE e.id_cliente = c.id ORDER BY e.datahora DESC) AS obs,
			datediff(DAY, dtevento, NOW()) AS dias
			FROM med_cliente AS c LEFT JOIN rh_usuario AS u ON c.id_med = u.id 
			WHERE c.id > 0 $FStatus $FFilial $FData) AS SUB ");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);

        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start 
            c.id AS Id, DATEFORMAT(C.data_cadastro, 'DD-MM-YYYY') AS data_cadastro, c.idXpert, loginName, c.RazaoSocial, c.cidade, c.status, 
			(SELECT TOP 1 e.datahora FROM med_cliente_evento AS e WHERE e.id_cliente = c.id ORDER BY e.datahora DESC) AS dtevento,
            DATEFORMAT(dtevento, 'DD-MM-YYYY HH:NN') as dataHora,
			(SELECT TOP 1 usuario FROM med_cliente_evento AS e WHERE e.id_cliente = c.id ORDER BY e.datahora DESC) AS usuario,
			(SELECT TOP 1 obs FROM med_cliente_evento AS e WHERE e.id_cliente = c.id ORDER BY e.datahora DESC) AS obs,
			datediff(DAY, dtevento, NOW()) AS dias
			FROM med_cliente AS c LEFT JOIN rh_usuario AS u ON c.id_med = u.id 
			WHERE c.id > 0 $FStatus $FFilial $FData");
        if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }
    public function dadosCadastrais($id)
    {

        $sql = $this->connection()->prepare("SELECT c.id, c.RazaoSocial, c.email, c.Contato, c.fone, c.CNPJ, c.endereco, c.bairro, c.cidade, c.uf, c.ie, c.nomeUsual, c.idXpert, c.cep, c.numEndereco, c.complEndereco, c.pessoa, c.status FROM med_cliente AS c WHERE id = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function dadosFinanceiros($id)
    {

        $sql = $this->connection()->prepare("SELECT c.id, c.carencia,c.limite,c.formaPgtoPadrao,c.prazoPgto,c.prazoAbast,
       c.forma_pgto1 AS fpg1,
       c.forma_pgto2 AS fpg2,
       c.forma_pgto3 AS fpg3,
       c.forma_pgto4 AS fpg4,
       c.forma_pgto5 AS fpg5,
       c.forma_pgto6 AS fpg6,
       c.forma_pgto7 AS fpg7,
       c.forma_pgto8 AS fpg8,
       c.forma_pgto9 AS fpg9,
       c.forma_pgtox AS fpgx,
        c.desc_alcool, c.desc_gasolina,c.desc_dieselS500,c.desc_dieselS10,c.desc_gnv,c.acr_alcool,c.acr_gasolina, c.acr_dieselS500, 
        c.acr_dieselS10, c.acr_gnv FROM med_cliente AS c WHERE id = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function dadosVeiculos($id)
    {

        $sql = $this->connection()->prepare("SELECT * FROM med_cliente_veiculo AS o WHERE o.id_cliente = :id ORDER BY o.id DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function dadosDocumentos($id)
    {

        $sql = $this->connection()->prepare("SELECT a.id_cliente, a.descricao, DATEFORMAT(a.data_pub, 'DD-MM-YYYY') AS datahora, a.usuario FROM med_cliente_documento AS a WHERE id_cliente = :id ORDER BY a.id DESC");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function dadosObservacao($id)
    {
        $sql = $this->connection()->prepare("SELECT o.id_cliente, o.obs, DATEFORMAT(o.data, 'DD-MM-YYYY') AS datahora, u.loginName AS usuario FROM med_cliente_obs AS o 
        LEFT JOIN ti_clientes AS u ON o.id_usuario = u.id 
        WHERE o.id_cliente = :id ");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function dadosEventos($id)
    {

        $sql = $this->connection()->prepare("SELECT e.obs, DATEFORMAT(e.datahora, 'DD-MM-YYYY HH:MM') AS datahora, e.usuario, e.id_cliente FROM med_cliente_evento AS e 
        WHERE e.id_cliente = :id ORDER BY e.datahora ");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function insertObservacao($id, $idUsuario, $obs)
    {

        $hoje = date('Y-m-d H:i:s');
        $sql = $this->connection()->prepare("INSERT INTO med_cliente_obs (id_cliente, id_usuario, data, obs) VALUES (:id, :idUser, :hoje, :obs)");
        $sql->bindValue('id', $id);
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('obs', $obs);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertEvento($id, $usuarioLogado, $evento)
    {

        $hoje = date('Y-m-d H:i:s');
        $sql = $this->connection()->prepare("INSERT INTO med_cliente_evento (id_cliente, usuario, datahora, obs) VALUES (:id,:user,:hoje,:evento)");
        $sql->bindValue('id', $id);
        $sql->bindValue('user', $usuarioLogado);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('evento', $evento);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertAnexo($descricao, $id, $extensao, $usuarioLogado)
    {
        $hoje = date('Y-m-d');
        $excluir = '0';

        $sql = $this->connection()->prepare("INSERT INTO med_cliente_documento (descricao, id_cliente, data_pub, usuario, extensao,excluir) VALUES (:descricao, :id, :hoje, :user, :extensao,:excluir)");
        $sql->bindValue('descricao', $descricao);
        $sql->bindValue('id', $id);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('user', $usuarioLogado);
        $sql->bindValue('extensao', $extensao);
        $sql->bindValue('excluir', $excluir);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertVeiculo($placa, $marca, $modelo, $ano, $km, $combustivel, $desconto, $cor, $id)
    {

        $sql = $this->connection()->prepare("INSERT INTO med_cliente_veiculo 
        (placa, marca, modelo, ano, km, combustivel, desconto, cor, id_cliente) VALUES 
        (:placa, :marca, :modelo, :ano, :km,:combustivel,:desconto,:cor,:id)");
        $sql->bindValue('placa', $placa);
        $sql->bindValue('marca', $marca);
        $sql->bindValue('modelo', $modelo);
        $sql->bindValue('ano', $ano);
        $sql->bindValue('km', $km);
        $sql->bindValue('combustivel', $combustivel);
        $sql->bindValue('desconto', $desconto);
        $sql->bindValue('cor', $cor);
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertCliente(
        $razaosocial,
        $emailCliente,
        $contato,
        $fone,
        $cnpj,
        $endereco,
        $bairro,
        $cidade,
        $uf,
        $ie,
        $nomeUsual,
        $idXpert,
        $cep,
        $numEndereco,
        $complEndereco,
        $pessoa,
        $status,
        $data_cadastro,
        $formaPgtoPadrao,
        $prazoPgto,
        $prazoAbast,
        $forma_pgto0,
        $forma_pgto1,
        $forma_pgto2,
        $forma_pgto3,
        $forma_pgto4,
        $forma_pgto5,
        $forma_pgto6,
        $forma_pgto7
    ) {

        $sql = $this->connection()->prepare("INSERT INTO med_cliente 
        (RazaoSocial,email,Contato,fone,CNPJ,endereco,bairro,cidade,uf,ie,nomeUsual,idXpert,cep,numEndereco,complEndereco,pessoa,status,data_cadastro,formaPgtoPadrao,prazoPgto,prazoAbast,forma_pgto0,forma_pgto1,forma_pgto2,forma_pgto3,forma_pgto4,forma_pgto5,forma_pgto6,forma_pgto7) VALUES
        (:RazaoSocial,:email,:Contato,:fone,:CNPJ,:endereco,:bairro,:cidade,:uf,:ie,:nomeUsual,:idXpert,:cep,:numEndereco,:complEndereco,:pessoa,:status,:data_cadastro,:formaPgtoPadrao,:prazoPgto,:prazoAbast,:forma_pgto0,:forma_pgto1,:forma_pgto2,:forma_pgto3,:forma_pgto4,:forma_pgto5,:forma_pgto6,:forma_pgto7)");
        $sql->bindValue('RazaoSocial', $razaosocial);
        $sql->bindValue('email', $emailCliente);
        $sql->bindValue('Contato', $contato);
        $sql->bindValue('fone', $fone);
        $sql->bindValue('CNPJ', $cnpj);
        $sql->bindValue('endereco', $endereco);
        $sql->bindValue('bairro', $bairro);
        $sql->bindValue('cidade', $cidade);
        $sql->bindValue('uf', $uf);
        $sql->bindValue('ie', $ie);
        $sql->bindValue('nomeUsual', $nomeUsual);
        $sql->bindValue('idXpert', $idXpert);
        $sql->bindValue('cep', $cep);
        $sql->bindValue('numEndereco', $numEndereco);
        $sql->bindValue('complEndereco', $complEndereco);
        $sql->bindValue('pessoa', $pessoa);
        $sql->bindValue('status', $status);
        $sql->bindValue('data_cadastro', $data_cadastro);
        $sql->bindValue('formaPgtoPadrao', $formaPgtoPadrao);
        $sql->bindValue('prazoPgto', $prazoPgto);
        $sql->bindValue('prazoAbast', $prazoAbast);
        $sql->bindValue('forma_pgto0', $forma_pgto0);
        $sql->bindValue('forma_pgto1', $forma_pgto1);
        $sql->bindValue('forma_pgto2', $forma_pgto2);
        $sql->bindValue('forma_pgto3', $forma_pgto3);
        $sql->bindValue('forma_pgto4', $forma_pgto4);
        $sql->bindValue('forma_pgto5', $forma_pgto5);
        $sql->bindValue('forma_pgto6', $forma_pgto6);
        $sql->bindValue('forma_pgto7', $forma_pgto7);
        $sql->execute();
    }
    public function updateClienteCadastral(
        $id,
        $razaosocial,
        $emailCliente,
        $contato,
        $fone,
        $cnpj,
        $endereco,
        $bairro,
        $cidade,
        $uf,
        $ie,
        $nomeUsual,
        $idXpert,
        $cep,
        $numEndereco,
        $complEndereco,
        $pessoa
    ) {

        $sql = $this->connection()->prepare("UPDATE med_cliente 
        SET RazaoSocial = :RazaoSocial, email = :email, Contato = :Contato, fone = :fone, CNPJ = :CNPJ,
        endereco = :endereco, bairro = :bairro, cidade = :cidade, uf = :uf, ie = :ie, nomeUsual = :nomeUsual,
        idXpert = :idXpert, cep = :cep, numEndereco = :numEndereco,
        complEndereco = :complEndereco ,pessoa = :pessoa WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('RazaoSocial', $razaosocial);
        $sql->bindValue('email', $emailCliente);
        $sql->bindValue('Contato', $contato);
        $sql->bindValue('fone', $fone);
        $sql->bindValue('CNPJ', $cnpj);
        $sql->bindValue('endereco', $endereco);
        $sql->bindValue('bairro', $bairro);
        $sql->bindValue('cidade', $cidade);
        $sql->bindValue('uf', $uf);
        $sql->bindValue('ie', $ie);
        $sql->bindValue('nomeUsual', $nomeUsual);
        $sql->bindValue('idXpert', $idXpert);
        $sql->bindValue('cep', $cep);
        $sql->bindValue('numEndereco', $numEndereco);
        $sql->bindValue('complEndereco', $complEndereco);
        $sql->bindValue('pessoa', $pessoa);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateClienteFinanceiro(
        $id,
        $formaPgtoPadrao,
        $prazoPgto,
        $prazoAbast,
        $forma_pgto0,
        $forma_pgto1,
        $forma_pgto2,
        $forma_pgto3,
        $forma_pgto4,
        $forma_pgto5,
        $forma_pgto6,
        $forma_pgto7,
        $desc_alcool,
        $desc_gasolina,
        $desc_dieselS500,
        $desc_dieselS10,
        $desc_gnv,
        $acr_alcool,
        $acr_gasolina,
        $acr_dieselS500,
        $acr_dieselS10,
        $acr_gnv
    ) {

        $sql = $this->connection()->prepare("UPDATE med_cliente 
        SET formaPgtoPadrao = :formaPgtoPadrao, prazoPgto = :prazoPgto, prazoAbast = :prazoAbast,
        forma_pgto0 = :forma_pgto0, forma_pgto1 = :forma_pgto1, forma_pgto2 = :forma_pgto2, forma_pgto3 = :forma_pgto3,
        forma_pgto4 = :forma_pgto4, forma_pgto5 = :forma_pgto5, forma_pgto6 = :forma_pgto6, forma_pgto7 = :forma_pgto7,
        desc_alcool = :desc_alcool, desc_gasolina = :desc_gasolina, desc_dieselS500 = :desc_dieselS500, desc_dieselS10 = :desc_dieselS10, desc_gnv = :desc_gnv, 
        acr_alcool = :acr_alcool, acr_gasolina = :acr_gasolina, acr_dieselS500 = :acr_dieselS500, acr_dieselS10 = :acr_dieselS10, acr_gnv = :acr_gnv   
        WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('formaPgtoPadrao', $formaPgtoPadrao);
        $sql->bindValue('prazoPgto', $prazoPgto);
        $sql->bindValue('prazoAbast', $prazoAbast);
        $sql->bindValue('forma_pgto0', $forma_pgto0);
        $sql->bindValue('forma_pgto1', $forma_pgto1);
        $sql->bindValue('forma_pgto2', $forma_pgto2);
        $sql->bindValue('forma_pgto3', $forma_pgto3);
        $sql->bindValue('forma_pgto4', $forma_pgto4);
        $sql->bindValue('forma_pgto5', $forma_pgto5);
        $sql->bindValue('forma_pgto6', $forma_pgto6);
        $sql->bindValue('forma_pgto7', $forma_pgto7);
        $sql->bindValue('desc_alcool', $desc_alcool);
        $sql->bindValue('desc_gasolina', $desc_gasolina);
        $sql->bindValue('desc_dieselS500', $desc_dieselS500);
        $sql->bindValue('desc_dieselS10', $desc_dieselS10);
        $sql->bindValue('desc_gnv', $desc_gnv);
        $sql->bindValue('acr_alcool', $acr_alcool);
        $sql->bindValue('acr_gasolina', $acr_gasolina);
        $sql->bindValue('acr_dieselS500', $acr_dieselS500);
        $sql->bindValue('acr_dieselS10', $acr_dieselS10);
        $sql->bindValue('acr_gnv', $acr_gnv);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
