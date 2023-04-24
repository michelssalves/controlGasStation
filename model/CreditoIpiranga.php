<?php
require 'chaves/Handlers.php';

class CreditoIpiranga extends Handlers
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
    public function findAll($filtroFilial, $filtroProduto, $filtroBandeira, $filtroPeriodo)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT DISTINCT
        c.IdFilial, 
        c.IdProduto, c.DataComprovante, 
        CASE WHEN  c.IdProduto = 1 THEN (SELECT TOP 1 p.preco_GasC      FROM med_concPrecos AS p LEFT JOIN med_concorrente AS c ON p.id_posto = c.id WHERE id_xpert = c.IdFilial AND data <= c.DataComprovante ORDER BY data DESC)
        WHEN  c.IdProduto = 2 THEN (SELECT TOP 1 p.preco_GasCAdit  FROM med_concPrecos AS p LEFT JOIN med_concorrente AS c ON p.id_posto = c.id WHERE id_xpert = c.IdFilial AND data <= c.DataComprovante ORDER BY data DESC)
        WHEN  c.IdProduto = 3 THEN (SELECT TOP 1 p.preco_etanol    FROM med_concPrecos AS p LEFT JOIN med_concorrente AS c ON p.id_posto = c.id WHERE id_xpert = c.IdFilial AND data <= c.DataComprovante ORDER BY data DESC)
        WHEN  c.IdProduto = 4 THEN (SELECT TOP 1 p.preco_Diesel    FROM med_concPrecos AS p LEFT JOIN med_concorrente AS c ON p.id_posto = c.id WHERE id_xpert = c.IdFilial AND data <= c.DataComprovante ORDER BY data DESC)
        WHEN  c.IdProduto = 5 THEN (SELECT TOP 1 p.preco_Diesel    FROM med_concPrecos AS p LEFT JOIN med_concorrente AS c ON p.id_posto = c.id WHERE id_xpert = c.IdFilial AND data <= c.DataComprovante ORDER BY data DESC)
        END AS PrecoVenda,
        
            (SELECT TOP 1  data FROM med_concPrecos AS p LEFT JOIN med_concorrente AS c ON p.id_posto = c.id WHERE id_xpert = c.IdFilial AND data <= c.DataComprovante ORDER BY data DESC)    AS DataPrecoVenda,
        
        c.IdEntidade, c.UfFilial, 
                        isnull((SELECT TOP 1 custo FROM med_precos_neg_ipiranga AS mpi 
                        WHERE mpi.IdEntidade = c.IdEntidade AND mpi.UFDestino = c.UfFilial AND mpi.IdProduto = c.IdProduto AND mpi.Data <= c.DataComprovante 
                        ORDER BY mpi.Data DESC),0) AS CustoNeg, 
                        
                    0 AS FreteNeg,    
                    CustoNeg + FreteNeg AS CF,
        
            mc.nome AS Posto,  
            mc.cidade AS Cidade,   
            mc.Bandeira AS Bandeira,  
        
        c.NomeEntidade,  c.NomeProduto, c.CidadeEntidade, UfEntidade, c.NrComprovante, c.Qtde, c.ValorUnitario, 
        c.Qtde * c.ValorUnitario AS ValorTotal,
        CASE WHEN c.NomeEntidade LIKE '%IPIRANGA%' THEN CF ELSE c.ValorUnitario END AS ValUnitNeg, 
        c.Qtde * ValUnitNeg AS ValTotNeg, ValorTotal - ValTotNeg AS Diferenca
        
        FROM med_compras_xpertN AS c 
        LEFT JOIN med_concorrente AS mc on c.idfilial = mc.id_xpert AND mc.principal = 1
        WHERE idfilial > 0  AND cancelado = 0
        $filtroFilial $filtroBandeira $filtroPeriodo $filtroProduto $filtroFilial 
        /*AND idFilial IN (11811) AND bandeira = 'RDP' AND month(c.DataComprovante) = 4 AND year(c.DataComprovante) = 2023  AND IdProduto IN (0,1,2,3,4,5,6,99) AND idFilial IN (11811) */
        ORDER BY DataComprovante DESC");
        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

}
