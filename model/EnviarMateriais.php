<?php
require 'chaves/Handlers.php';

class EnviarMaterial extends Handlers
{

    public function __construct()
    {

    }
    public function findLastId(){

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM REQ_Pedido ORDER BY id DESC"); 
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id'];
    }
    public function selectAllClasses()
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT id, descricao FROM REQ_ClasseProduto WHERE statusClasse IS NULL");
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectProdutos($classe)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT id, descricao FROM REQ_Produto WHERE classe = :classe");
        $sql->bindValue('classe', $classe);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function findAll($Fstatus, $Fmed, $Fproduto, $start, $resultadoPorPagina)
    {
        $data = [];

        $sql = $this->connection()->prepare("SELECT  COUNT(*) AS resultados FROM (SELECT p.id AS id_pedido, p.codcliente, u.loginName, DATEFORMAT(p.data, 'DD-MM-YYYY') AS dataPedido, DATEFORMAT(p.data_entrega, 'DD-MM-YYYY') AS dataEntrega, p.obs,
        (SELECT count() FROM REQ_ItemPedido WHERE id_pedido = p.id) AS itens, 
        (SELECT list(desc_produto)FROM REQ_ItemPedido WHERE id_pedido = p.id) AS lista,
        p.itens_parcial, p.status
        FROM REQ_Pedido AS p 
        LEFT JOIN ti_clientes AS u ON p.codcliente = u.id
        WHERE status <> 'CRIADO' AND p.id > 0  $Fstatus $Fmed $Fproduto) AS SUB");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);
        
        $sql = $this->connection()->prepare("SELECT TOP $resultadoPorPagina START AT $start 
        p.id AS id_pedido, p.codcliente, u.loginName,  DATEFORMAT(p.data, 'DD-MM-YYYY') AS dataPedido, DATEFORMAT(p.data_entrega, 'DD-MM-YYYY') AS dataEntrega, p.obs,
        (SELECT count() FROM REQ_ItemPedido WHERE id_pedido = p.id) AS itens, 
        (SELECT list(desc_produto)FROM REQ_ItemPedido WHERE id_pedido = p.id) AS lista,
        p.itens_parcial, p.status
        FROM REQ_Pedido AS p 
        LEFT JOIN ti_clientes AS u ON p.codcliente = u.id
        WHERE status <> 'CRIADO' AND p.id > 0  $Fstatus $Fmed $Fproduto");
       
       if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
       // return var_dump($sql);
        
    }
    public function findById($id)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT i.id AS item, i.id_pedido AS pedido, i.desc_produto, i.quant, 'env', 'saldo', p.qtde_atual, DATEFORMAT(i.data_envio, 'DD-MM-YYYY') AS dataEnvio,  DATEFORMAT(i.data_recebido, 'DD-MM-YYYY') AS dataRecebimento, pd.status
        FROM REQ_ItemPedido AS i 
        LEFT JOIN REQ_Produto AS p ON i.id_produto = p.id
        LEFT JOIN REQ_Pedido AS pd ON pd.id = i.id_pedido
        WHERE id_pedido = :id AND status_item IS NULL");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function findByIdItem($id)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT i.id AS item, i.id_pedido AS pedido, i.desc_produto, i.quant
        FROM REQ_ItemPedido AS i 
        LEFT JOIN REQ_Produto AS p ON i.id_produto = p.id
        LEFT JOIN REQ_Pedido AS pd ON pd.id = i.id_pedido
        WHERE i.id = :id AND status_item IS NULL");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function selectObservacao($id)
    {
        $data = [];
        $sql = $this->connection()->prepare("SELECT DATEFORMAT(data_hora, 'DD-MM-YYYY HH:MM') AS datahora, obs, usuario  FROM REQ_Pedido_obs WHERE id_pedido = :id");
        $sql->bindValue('id', $id);
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
   
    }
    public function insertObservacao($id, $usuarioLogado, $observacao)
    {
        
        $hoje = date('Y-m-d H:i:s');

        $sql = $this->connection()->prepare("INSERT INTO REQ_Pedido_obs (id_pedido, usuario, data_hora, obs) 
        VALUES (:id, :usuario, :dataHr, :obs)");
        $sql->bindValue('id', $id);
        $sql->bindValue('usuario', $usuarioLogado);
        $sql->bindValue('dataHr', $hoje);
        $sql->bindValue('obs', $observacao);
        $sql->execute();

        return true;

   
    }
    public function updateStatus($id, $status)
    {

        $sql = $this->connection()->prepare("UPDATE REQ_Pedido SET status = :stt WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('stt', $status);
        $sql->execute();
        
        return true;
       

    }
    public function updateQtdeItem($id, $quantidade)
    {

        $sql = $this->connection()->prepare("UPDATE REQ_ItemPedido SET quant = :quant WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('quant', $quantidade);
        $sql->execute();
        
        return true;
       

    }
    public function updateCancelarItem($id)
    {
        $status = 'EXCLUIDO';
        $sql = $this->connection()->prepare("UPDATE REQ_ItemPedido SET status_item = :stt WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('stt', $status);
        $sql->execute();
        
        return true;
       

    }
    public function updateCancelarPedido($id)
    {
        $status = 'CANCELADO';
        $sql = $this->connection()->prepare("UPDATE REQ_Pedido SET status = :stt WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('stt', $status);
        $sql->execute();
        
        return true;
       

    }
    public function insertPedido($idUsuario){

        $hoje = date('Y-m-d');
        $status = 'NOVO';

        $sql = $this->connection()->prepare("INSERT INTO REQ_Pedido (codcliente, data, status) 
        VALUES (:idUser, :hoje, :stt)");
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('hoje', $hoje);
        $sql->bindValue('stt', $status);
        if($sql->execute()){
            return true;
        }else{
            return false;
        }

    }
    public function insertItens($idPedido, $idProduto, $qtde, $descricao, $tam){
      
        for($x=0; $x<$tam; $x++){

            $sql = $this->connection()->prepare("INSERT INTO REQ_ItemPedido (id_pedido, id_produto, quant, desc_produto) 
            VALUES (:idPedido, :idProduto, :qtde, :descr)");
            $sql->bindValue('idPedido', $idPedido);
            $sql->bindValue('idProduto', $idProduto[$x]);
            $sql->bindValue('qtde', $qtde[$x]);
            $sql->bindValue('descr', $descricao[$x]);
            $sql->execute();
         } 

        return true; 
          
    }
}