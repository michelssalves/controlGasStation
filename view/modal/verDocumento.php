<?php

$action = $_REQUEST['action'];

if($action == 'controleDocumentos'){

    echo "<iframe src='https://www.rdppetroleo.com.br/medwebnovo/assets/docs/modelosDeDocumentos/".$_REQUEST['id']."' width='100%' height='100%' id='iframe1' marginheight='0' frameborder='0' onLoad='autoResize('iframe1');'></iframe>";

}else{

    echo "<iframe src='https://www.rdppetroleo.com.br/medweb/fechamentoCaixa/docs/".$_REQUEST['id'].".pdf' width='100%' height='100%' id='iframe1' marginheight='0' frameborder='0' onLoad='autoResize('iframe1');'></iframe>";
}

