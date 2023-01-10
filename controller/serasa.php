<?php
$action = $_REQUEST['action'];

if($action == 'solicitarPfin'){

    $descricaoAnexo = "FATURAS";   				
    $status= "NOVO";
    $tipoDoc = $_REQUEST['tipoDoc'];
    $cnpj = $_REQUEST['cnpj'];
    $valor = virgulaParaPonto($_REQUEST['valor']);
    $valorJuros = $valor * 1.03;
    $id_med = $_REQUEST['id_med'];
    $nomeCliente = limpaObservacao($_REQUEST['nomeCliente']);
    $endereco = $_REQUEST['endereco'];
    $estado = $_REQUEST['estado'];
    $cidade = $_REQUEST['cidade'];
    $bairro = $_REQUEST['bairro'];
    $numero = $_REQUEST['numero'];
    $cep = $_REQUEST['cep'];
    $obs = limpaObservacao($_REQUEST['obs']);
    $dataEmissao = ($_REQUEST['dataEmissao'] <> '' ? $_REQUEST['dataEmissao'] : '2000-01-01');
    $dataVencimento = ($_REQUEST['dataVencimento'] <> '' ? $_REQUEST['dataVencimento'] : '2000-01-01');
    $dataNascimento = ($_REQUEST['dataNascimento'] <> '' ? $_REQUEST['dataNascimento'] : '2000-01-01');

    if($_SESSION['login'] == "SUPORTE"){
			
    $sql = ("INSERT INTO ccp_serasa (cnpj,tipo, nomeCliente, status, valor, obs, valorJuros, dataEmissao, dataVencimento, id_med, dataNascimento, endereco, matriz, estado, cidade, bairro, numero, cep) 
    VALUES ('$cnpj','$tipoDoc', '$nomeCliente', '$status', '$valor','$obs', '$valorJuros', '$dataEmissao', '$dataVencimento', '$id_med', '$dataNascimento', '$endereco', '1', '$estado', '$cidade', '$bairro', '$numero', '$cep')");
    var_dump($sql);

    }else{

    $sql = ("INSERT INTO ccp_serasa (cnpj,tipo, nomeCliente, status, valor, obs, valorJuros, dataEmissao, dataVencimento, id_med, dataNascimento, endereco, estado, cidade, bairro, numero, cep) 
    VALUES ('$cnpj','$tipoDoc', '$nomeCliente', '$status', '$valor','$obs', '$valorJuros', '$dataEmissao', '$dataVencimento', '$id_med', '$dataNascimento', '$endereco', '$estado', '$cidade', '$bairro', '$numero', '$cep')");
    var_dump($sql);

	}

    $idFechamentoCaixaAnexo = 1500;
    for ($i = 1; $i <= 5; $i++){

        if($_FILES["arquivo$i"]['name'] <> ''){

            echo "Filename: " . $_FILES["arquivo$i"]['name']."<br>"; 
            echo "Type : " . $_FILES["arquivo$i"]['type'] ."<br>"; 
            echo "Size : " .$_FILES["arquivo$i"]['size'] ."<br>";
            echo "Temp name: " . $_FILES["arquivo$i"]['tmp_name'] ."<br>";
            echo "Error : " . $_FILES["arquivo$i"]['error'] . "<br>";
    
            $numDoc = $_REQUEST["numDoc$i"];

            $tabela = 'ccp_serasa';
            $campo = 'id_requisicao';
            $id_requisicao =  selectUltimoId($tabela, $campo);
            
            $extensao = strtolower(end(explode('.', $_FILES["arquivo$i"]['name'])));

            $sql2 = ("INSERT INTO ccp_serasa_anexo (id_requisicao, numDoc, descricao, extensao) VALUES ('$id_requisicao','$numDoc','$descricaoAnexo','$extensao')");
            var_dump($sql2);

            $temp = $_FILES["arquivo$i"]['tmp_name'];
            $localDeArmazenagem = "assets/docs/serasa/";
            $tabela = 'ccp_serasa_anexo';
        
            uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem, $idFechamentoCaixaAnexo);

            $idFechamentoCaixaAnexo++;
        }
        }

        $evento = "SOLICITAÇÃO DE PEFIN";

        $sql3 = ("INSERT INTO ccp_serasa_eventos (id, id_requisicao, evento, usuario, datahora) 
        VALUES ('$id_requisicao', '$evento', '$usuarioLogado', '".date("Y-m-d H:i:s")."')");
    var_dump($sql3);
     
}
if($action == 'gravarObservacao'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $observacao = limpaObservacao($_REQUEST['observacao']);
    $datahora = date('Y-m-d H:i:s');

    $sql =  ("INSERT INTO ccp_serasa_obs (id_requisicao, datahora, usuario, obs) VALUES ( '$id_requisicao', '".date('Y-m-d H:i:s')."', '$usuarioLogado', '$observacao' )");
    //odbc_exec($connP, $sql);
    var_dump($sql);


}
if($action == 'gravarAnexo'){

    $id_requisicao  = $_REQUEST['id_requisicao'];
    $numDoc 		= $_REQUEST['numDoc'];
    $descricaoAnexo = "ANEXO";

    if ($_FILES['file']['name'] <> ''){

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
        //ver da onde vem o idrequisicao
        $sql = ("INSERT INTO ccp_serasa_anexo (id_requisicao, numDoc, descricao, extensao) VALUES ('$id_requisicao','$numDoc','$descricaoAnexo','$extensao')");
        //odbc_exec($connP, $sql);
        var_dump($sql);

        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "assets/docs/serasa/";
        $tabela = 'ccp_serasa_anexo';
    
      //  uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

		$evento = "ADICIONOU UM ANEXO";
        $sql1 = ("INSERT INTO ccp_serasa_eventos (id_requisicao, evento, usuario, datahora) VALUES ('$id_requisicao', '$evento', '$usuarioLogado', '".date('Y-m-d H:i:s')."')");
		//odbc_exec($connP,$sql);
        var_dump($sql1);
    }
}
if($action == 'paraPefin'){

    $id_requisicao = $_REQUEST['id_requisicao'];
    $numDoc = $_REQUEST['numDoc'];
    $descricaoAnexo = "DOC. REGISTRO";

    $sql = ("UPDATE ccp_serasa SET status = 'PEFIN' WHERE id_requisicao = $id_requisicao");
    //odbc_exec($connP,$sql);
    var_dump($sql);

    if ($_FILES['arquivo']['name'] <> ''){

    $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

    $sql1 = ("INSERT INTO ccp_serasa_anexo (id_requisicao, numDoc, descricao, extensao) VALUES ('$id_requisicao','$numDoc','$descricaoAnexo','$extensao')");
    //odbc_exec($connP,$sql);
    var_dump($sql1);

    $temp = $_FILES['file']['tmp_name'];
    $localDeArmazenagem = "assets/docs/serasa/";
    $tabela = 'ccp_serasa_anexo';

   // uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

    }

}
if($action == 'cancelarRequisicao'){

        $id_requisicao = $_REQUEST['id_requisicao'];
        $evento = "CANCELOU A REQUISIÇÃO";
        $descricaoAnexo = "DOC. BAIXA";

		$sql = ("UPDATE ccp_serasa SET status = 'CANCELADO' WHERE id_requisicao = $id_requisicao");
        var_dump($sql);
       // odbc_exec($connP, $sql);
        $sql1 = ("INSERT INTO ccp_serasa_eventos (id_requisicao, evento, usuario, datahora) VALUES ('$id_requisicao', '$evento', '$usuarioLogado', '".date('Y-m-d H:i:s')."')");
        //odbc_exec($connP, $sql);
        var_dump($sql1);

        if ($_FILES['file']['name'] <> ''){

            $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));
             
            $sql = ("INSERT INTO ccp_serasa_anexo (id_requisicao, numDoc, descricao, extensao) VALUES ('$id_requisicao','$numDoc','$descricaoAnexo','$extensao')");
            //odbc_exec($connP, $sql);
            var_dump($sql);
    
            $temp = $_FILES['file']['tmp_name'];
            $localDeArmazenagem = "assets/docs/serasa/";
            $tabela = 'ccp_serasa_anexo';
        
           // uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);
    
            $evento = "ALTEROU O STATUS PARA CANCELADO";
            $sql1 = ("INSERT INTO ccp_serasa_eventos (id_requisicao, evento, usuario, datahora) VALUES ('$id_requisicao', '$evento', '$usuarioLogado', '".date('Y-m-d H:i:s')."')");
            //odbc_exec($connP,$sql);
            var_dump($sql1);
        }

}
if($action == 'baixarRequisicao'){

        $id_requisicao = $_REQUEST['id_requisicao'];
        $numDoc = limpaObservacao($_REQUEST['numDoc']);

        if ($_FILES['file']['name'] <> ''){

        $sql = ("UPDATE ccp_serasa SET status = 'BAIXADO' WHERE id_requisicao = $id_requisicao"); //ALTERA O STATUS PARA BAIXADO
        //odbc_exec($connP,$sql);
        var_dump($sql);

        $extensao = strtolower(end(explode('.', $_FILES['file']['name'])));

        $descricaoAnexo = "DOC. BAIXA";
        $sql1 = ("INSERT INTO ccp_serasa_anexo (id_requisicao, numDoc, descricao, extensao) VALUES ('$id_requisicao','$numDoc','$descricaoAnexo','$extensao')");
        //odbc_exec($connP, $sql);
        var_dump($sql1);


        $temp = $_FILES['file']['tmp_name'];
        $localDeArmazenagem = "assets/docs/serasa/";
        $tabela = 'ccp_serasa_anexo';
    
        //uploadArquivo($temp, $extensao, $tabela, $localDeArmazenagem);

        $evento = "ALTEROU O STATUS PARA BAIXADO";

        $sql2 = ("INSERT INTO ccp_serasa_eventos (id_requisicao, evento, usuario, datahora) VALUES ('$id_requisicao', '$evento', '$usuarioLogado', '".date('Y-m-d H:i:s')."')");
		//odbc_exec($connP,$sql);
        var_dump($sql2);
			
        }
}

    $sql = ("SELECT TOP 50 u.id, u.loginName, f.id_requisicao, f.tipo, f.cnpj, f.nomeCliente, f.status, f.obs, f.valor, f.valorJuros, f.id_cliente, f.dataEmissao, f.dataVencimento, f.id_med,
            f.endereco, f.estado, f.cidade, f.bairro, f.numero, f.cep, f.dataNascimento
            FROM ccp_serasa AS f
            JOIN rh_usuario AS u ON f.id_med = u.id
            WHERE matriz = 0 AND id_requisicao > 0  AND status = 'PEFIN' ORDER  BY f.id_requisicao DESC ");
    $qry = odbc_exec($connP, $sql);
    $x=0;
    while($row = odbc_fetch_array($qry)){

    extract($row);
    //atribui um id a todos os modais gerados no loop
	$modalVisualizar= "modalVisualizar$x";
	//gatilho para ativação do modal
	$linkModalVisualizar = "data-bs-toggle='modal' data-bs-target='#$modalVisualizar' style='cursor:pointer'";

       $txtTable .= "<tr $linkModalVisualizar>
            <td>".$loginName."</a></td>
            <td>".$tipo."</a></td>
            <td>".$nomeCliente."</a></td>
            <td>".v2($valor)."</td>
            <td>".dma($dataEmissao)."</td>
            <td>".dma($dataVencimento)."</td>
            <td>".($matriz == 1 ? 'Sim' : 'Não' )."</td>
        </tr>";

       include 'view/modal/serasa/serasaVisualizar.view.php';   

        $x++;
    }
    
       include 'view/modal/serasa/serasaCancelarRequisicao.view.php';   
       include 'view/modal/serasa/serasaCriarPfin.view.php';   
       include 'view/modal/serasa/serasaBaixarRequisicao.view.php';  
       include 'view/modal/serasa/serasaIncluirObservacao.view.php';   
       include 'view/modal/serasa/serasaIncluirAnexo.view.php';   
       