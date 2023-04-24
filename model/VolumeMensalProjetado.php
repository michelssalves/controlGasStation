<?php
require 'chaves/Handlers.php';

class VolumeMensalProjetado extends Handlers
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
    public function findLastId()
    {

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM med_cliente ORDER BY id DESC");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);

        return $resultados['id'];
    }
    public function findConveniencia($idGrupo,$filtroGerencia, $mes, $ano, $dia)
    {

        $data = [];
        $periodo = "$ano-$mes-$dia";
        $sql = $this->connection()->prepare("SELECT DISTINCT id_filial,  loginname ,id_grupo, 
		isnull((SELECT sum(valor) AS val FROM med_movprodutos WHERE id_filial = m.id_filial AND id_grupo = $idGrupo AND id_produto = 999 AND mes = $mes AND ano = $ano  ),0) AS vendas,
		isnull((SELECT sum(valor) AS val FROM med_movprodutos WHERE id_filial = m.id_filial AND id_grupo = $idGrupo AND id_produto = 5 AND mes = $mes AND ano = $ano  ),0) AS cigarro,
        vendas + cigarro AS totalVendido,
		isnull((SELECT percentual FROM med_MetasMes WHERE id_filial = m.id_filial AND data = '$periodo'),0) AS perc_mes,
		isnull((SELECT meta FROM med_Metasano WHERE id_filial = m.id_filial AND id_grupo = $idGrupo AND ano = $ano),0) AS meta_anual,
        meta_anual * perc_mes / 100 AS meta_mes,
        vendas * 100 / meta_mes AS percentualMetaMes
		FROM med_movprodutos AS m LEFT JOIN ti_clientes AS c on m.id_filial = c.id_xpert 
		WHERE c.inativo = 0 $filtroGerencia AND id_grupo = $idGrupo AND loginname IS NOT  NULL
		ORDER BY loginname");
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function findOutros($idGrupo,$filtroGrupo, $filtroGerencia, $campo, $filtroProduto, $mes, $ano, $dia)
    {

        $data = [];
        $periodo = "$ano-$mes-$dia";
        $sql = $this->connection()->prepare("SELECT DISTINCT id_filial, loginname,id_grupo,
		isnull((SELECT sum($campo) AS val FROM med_movprodutos WHERE id_filial = m.id_filial $filtroProduto AND mes = $mes AND ano = $ano),0) AS vendas,
		vendas AS totalVendido,
        isnull((SELECT percentual FROM med_MetasMes WHERE id_filial = m.id_filial AND data = '$periodo'),0) AS perc_mes,
		isnull((SELECT meta FROM med_Metasano WHERE id_filial = m.id_filial AND id_grupo = $idGrupo AND ano = $ano ),0) AS meta_anual,
		meta_anual * perc_mes / 100 AS meta_mes,
        vendas * 100 / meta_mes AS percentualMetaMes
		FROM med_movprodutos AS m LEFT JOIN ti_clientes AS c ON m.id_filial = c.id_xpert 
		WHERE c.inativo = 0 $filtroGerencia $filtroGrupo AND loginname IS NOT NULL
		ORDER BY loginname");
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

}
