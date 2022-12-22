<?php 
$doc = $_REQUEST['doc'];
$pasta = $_REQUEST['pasta'];

$tipo = explode('.',$doc);

//$raiz = "../../assets/docs/".$pasta."/".$doc; original
$raiz = "../../../medweb/fechamentoCaixa/docs/".$doc;

?>
<embed src="<?=$raiz?>" width="100%" height="100%" />   


 


