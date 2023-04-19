<?php
require 'chaves/Handlers.php';

class PrecosPracaAnalise extends Handlers
{

    public function __construct()
    {

    }
    public function findAll($filtroBandeira, $filtroMed, $start, $resultadoPorPagina)
    {

        $data = [];

        $sql = $this->connection()->prepare("SELECT COUNT(*) AS resultados FROM (SELECT u.loginname AS med, u.id AS id_filial, c.Nome AS nome, c.id AS idConcorrente, c.bandeira, distancia, cp.preco_GasC, cp.preco_GasCAdit, 
		cp.preco_etanol, cp.preco_Diesel, cp.preco_DieselAdit, preco_GNV, DATEFORMAT(cp.data, 'DD-MM-YYYY') AS dataAtu, principal AS princ
		FROM med_concorrente AS c 
		LEFT JOIN med_concPrecosN AS cp ON c.id = cp.id_posto 
		LEFT JOIN ti_clientes AS u ON c.id_med = u.id
		WHERE data > dateadd(dd, -45, today())  
		AND id_preco = (SELECT TOP 1 cp2.id_preco FROM med_concPrecosN AS cp2 WHERE cp2.id_posto = cp.id_posto ORDER BY cp2.id_preco DESC)
		$filtroBandeira $filtroMed
        ORDER BY principal DESC, med, dataAtu DESC) AS SUB ");
        $sql->execute();
        $resultados = $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);


        $sql = $this->connection()->prepare("SELECT TOP :rp START AT :ini
        u.loginname AS med, u.id AS id_filial, c.Nome AS nome, c.id AS idConcorrente, c.bandeira, distancia, cp.preco_GasC, cp.preco_GasCAdit, 
		cp.preco_etanol, cp.preco_Diesel, cp.preco_DieselAdit, preco_GNV, DATEFORMAT(cp.data, 'DD-MM-YYYY') AS dataAtu, principal AS princ
		FROM med_concorrente AS c 
		LEFT JOIN med_concPrecosN AS cp ON c.id = cp.id_posto 
		LEFT JOIN ti_clientes AS u ON c.id_med = u.id
		WHERE data > dateadd(dd, -45, today())  
		AND id_preco = (SELECT TOP 1 cp2.id_preco FROM med_concPrecosN AS cp2 WHERE cp2.id_posto = cp.id_posto ORDER BY cp2.id_preco DESC)
		$filtroBandeira $filtroMed
        ORDER BY principal DESC, med, dataAtu DESC");
        $sql->bindValue('rp', $resultadoPorPagina);
        $sql->bindValue('ini', $start);
        
        if ($sql->execute()) {
            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
}
