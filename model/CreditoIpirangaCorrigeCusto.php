<?php
require 'chaves/Handlers.php';

class CorrigeCusto extends Handlers
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
    public function findPeriodo()
    {

        $sql = $this->connection()->prepare("SELECT DISTINCT 
            CASE 
            WHEN mes = 1 THEN 'JAN'
            WHEN mes = 2 THEN 'FEV'
            WHEN mes = 3 THEN 'MAR'
            WHEN mes = 4 THEN 'ABR'
            WHEN mes = 5 THEN 'MAI'
            WHEN mes = 6 THEN 'JUN'
            WHEN mes = 7 THEN 'JUL'
            WHEN mes = 8 THEN 'AGO'
            WHEN mes = 9 THEN 'SET'
            WHEN mes = 10 THEN 'OUT'
            WHEN mes = 11 THEN 'NOV'
            WHEN mes = 12 THEN 'DEZ'
            ELSE 'Mês Inválido'
            END AS nomeMes,
            mes, 
            ano, 
            mes
            FROM med_movprodutos 
            ORDER BY ano DESC, mes DESC");


        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }
    public function findAll($filtroProduto, $filtroOrigem, $filtroDestino, $filtroPeriodo)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT PI.IdEntidade AS ORIGEM,PI.UFDestino AS DESTINO, PI.IdProduto, PI.Data, PI.Custo, PI.Frete, PI.Usuario,
        (SELECT TOP 1 NomeProduto FROM med_compras_xpertN WHERE IdProduto = PI.IdProduto) AS descricao,
        (SELECT TOP 1 CidadeEntidade FROM med_compras_xpertN WHERE idEntidade = ORIGEM) AS cidadeOrigem
        FROM med_precos_neg_ipiranga AS PI 
        WHERE PI.IdProduto > 0 $filtroProduto $filtroOrigem $filtroDestino $filtroPeriodo
        ORDER BY PI.IdProduto, PI.data DESC, PI.IdEntidade, PI.UFDestino");
        //return var_dump($sql);
        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function findAllFretes(){

        $data = [];

        $sql = $this->connection()->prepare("SELECT * FROM med_frete_neg_ipiranga ORDER BY IdProduto, UFDestino, Origem");
        //return var_dump($sql);
        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;


    }
    public function updateFrete($p, $u, $o, $f){

        $data = [];

        $sql = $this->connection()->prepare("INSERT INTO med_frete_neg_ipiranga (IdProduto, UFDestino, Origem, Frete) ON EXISTING UPDATE VALUES ($p, '$u', '$o', $f)");
        //return var_dump($sql);
        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;


    }


}
