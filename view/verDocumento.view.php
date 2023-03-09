<?php

$action = $_REQUEST['action'];

if($_REQUEST['p'] == 'solicitacaoPgtos'){
    //old 
    echo "<iframe src='https://www.rdppetroleo.com.br/medweb/rp/doc/".$_REQUEST['id'].".".$_REQUEST['ext']."' width='100%' height='100%' id='iframe1' marginheight='0' frameborder='0' onLoad='autoResize('iframe1');'></iframe>";

    //new echo "<iframe src='https://www.rdppetroleo.com.br/medwebnovo/assets/docs/".$_REQUEST['p']."/".$_REQUEST['id'].".".$_REQUEST['ext']."' width='100%' height='100%' id='iframe1' marginheight='0' frameborder='0' onLoad='autoResize('iframe1');'></iframe>";


}
if($_REQUEST['p'] == 'controleDocumentos'){
    //new
    echo "<iframe src='https://www.rdppetroleo.com.br/medwebnovo/assets/docs/modelosDeDocumentos/".$_REQUEST['id']."' width='100%' height='100%' id='iframe1' marginheight='0' frameborder='0' onLoad='autoResize('iframe1');'></iframe>";

}else{

    echo "<iframe src='https://www.rdppetroleo.com.br/medweb/fechamentoCaixa/docs/".$_REQUEST['id'].".".$_REQUEST['ext']."' width='100%' height='100%' id='iframe1' marginheight='0' frameborder='0' onLoad='autoResize('iframe1');'></iframe>";
}
