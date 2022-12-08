<?php 
$doc = $_REQUEST['doc'];
$pasta = $_REQUEST['pasta'];

$tipo = explode('.',$doc);

$raiz = "../../assets/docs/".$pasta."/".$doc;

//echo $tipo[1] ;
?>
<embed src="<?=$raiz?>" width="100%" height="100%" />   


 


