<?php
require 'chaves/Handlers.php';

class PrecosPraca extends Handlers
{

    public function __construct()
    {

    }
    public function findAll($idUsuario, $start, $resultadoPorPagina)
    {
        $data = [];

        $sql = $this->connection()->prepare("SELECT COUNT(*) AS resultados FROM (SELECT c.id AS cid, nome, bandeira, c.distancia, isnull(c.principal,0) AS princ, cp.preco_GasC, cp.preco_GasCAdit, cp.preco_etanol, cp.preco_Diesel, cp.preco_DieselAdit,cp.preco_GNV, data, endereco, bairro, cidade, uf, cep
		FROM med_concorrente AS c 
		LEFT JOIN med_concPrecosN AS cp ON c.id = cp.id_posto 
		WHERE isnull(status,'') <> 'I' AND data > dateadd(dd, -45, today()) 
        AND id_preco = (SELECT TOP 1 cp2.id_preco FROM med_concPrecosN AS cp2 WHERE cp2.id_posto = cp.id_posto ORDER BY cp2.id_preco DESC)
		AND id_med = :idUser) AS SUB ");
        $sql->bindValue('idUser', $idUsuario);
        $sql->execute();
        $resultados = $sql->fetch(PDO::FETCH_ASSOC);
        $data[0] = ceil($resultados['resultados'] / $resultadoPorPagina);


        $sql = $this->connection()->prepare("SELECT TOP :rp START AT :ini
        c.id AS cid, nome, bandeira, c.distancia, isnull(c.principal,0) AS princ, cp.preco_GasC, cp.preco_GasCAdit, cp.preco_etanol, cp.preco_Diesel, cp.preco_DieselAdit,cp.preco_GNV, DATEFORMAT(cp.data, 'DD-MM-YYYY') AS dataAtu, endereco, bairro, cidade, uf, cep
		FROM med_concorrente AS c 
		LEFT JOIN med_concPrecosN AS cp ON c.id = cp.id_posto 
		WHERE isnull(status,'') <> 'I' AND data > dateadd(dd, -45, today()) 
        AND id_preco = (SELECT TOP 1 cp2.id_preco FROM med_concPrecosN AS cp2 WHERE cp2.id_posto = cp.id_posto ORDER BY cp2.id_preco DESC)
		AND id_med = :idUser
        ORDER BY princ DESC, nome");
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('rp', $resultadoPorPagina);
        $sql->bindValue('ini', $start);

        if ($sql->execute()) {

            $data[1] = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }
    }
    public function findById($id)
    {

        $data = [];
        $sql = $this->connection()->prepare("SELECT c.id AS cid, nome, bandeira, c.distancia, isnull(c.principal,0) AS princ, cp.preco_GasC, cp.preco_GasCAdit, cp.preco_etanol, cp.preco_Diesel, cp.preco_DieselAdit,cp.preco_GNV, data, endereco, bairro, cidade, uf, cep
		FROM med_concorrente AS c 
		LEFT JOIN med_concPrecosN AS cp ON c.id = cp.id_posto 
		WHERE isnull(status,'') <> 'I' AND data > dateadd(dd, -45, today()) 
        AND id_preco = (SELECT TOP 1 cp2.id_preco FROM med_concPrecosN AS cp2 WHERE cp2.id_posto = cp.id_posto ORDER BY cp2.id_preco DESC)
		AND cid = :idConcorrente");
        $sql->bindValue('idConcorrente', $id);
        $sql->execute();
        if ($sql->execute()) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function findLastId()
    {

        $sql = $this->connection()->prepare("SELECT TOP 1 id FROM med_concorrente ORDER BY id DESC");
        $sql->execute();
        $resultados =  $sql->fetch(PDO::FETCH_ASSOC);
        $resultados = $resultados['id'];

        return $resultados;
    }
    public function insertConcorrente($nome, $bandeira, $idUsuario, $distancia, $endereco, $bairro, $cep, $cidade, $uf, $idXpert)
    {
        $dataCadastro = date('Y-m-d');

        $sql = $this->connection()->prepare("INSERT INTO med_concorrente 
        (nome, bandeira, dataCadastro, id_med, distancia, endereco, bairro, cep, cidade, uf, id_xpert) VALUES
        (:nome, :bandeira, :dataCadastro, :idUser, :distancia, :endereco, :bairro, :cep, :cidade, :uf, :id_xpert)");
        $sql->bindValue('nome', $nome);
        $sql->bindValue('bandeira', $bandeira);
        $sql->bindValue('dataCadastro', $dataCadastro);
        $sql->bindValue('idUser', $idUsuario);
        $sql->bindValue('distancia', $distancia);
        $sql->bindValue('endereco', $endereco);
        $sql->bindValue('bairro', $bairro);
        $sql->bindValue('cep', $cep);
        $sql->bindValue('cidade', $cidade);
        $sql->bindValue('uf', $uf);
        $sql->bindValue('id_xpert', $idXpert);
        if ($sql->execute()) {

            return true;
        } else {

            return false;
        }
    }
    public function insertConcorrenteTabelaPrecos($idPosto)
    {

        $dataAtual = date('Y-m-d');
        $sql = $this->connection()->prepare("INSERT INTO med_concPrecosN (id_posto, data) VALUES (:id, :dataReg)");
        $sql->bindValue('id', $idPosto);
        $sql->bindValue('dataReg', $dataAtual);
        if ($sql->execute()) {

            return true;
        } else {

            return false;
        }
    }
    public function updateConcorrente($gasC, $gasAd, $etanol, $diesel, $dieselAd, $gnv, $idConc)
    {
        $dataAtual = date('Y-m-d');

        $sql = $this->connection()->prepare("INSERT INTO med_concPrecosN 
        (id_posto, data, preco_GasC, preco_GasCAdit, preco_etanol, preco_Diesel, preco_DieselAdit, preco_GNV) VALUES
        (:idConc, :dataAt, :gasC, :gasAd, :etanol, :diesel, :dieselAd, :gnv)");
        $sql->bindValue('idConc', $idConc);
        $sql->bindValue('dataAt', $dataAtual);
        $sql->bindValue('gasC', $gasC);
        $sql->bindValue('gasAd', $gasAd);
        $sql->bindValue('etanol', $etanol);
        $sql->bindValue('diesel', $diesel);
        $sql->bindValue('dieselAd', $dieselAd);
        $sql->bindValue('gnv', $gnv);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
