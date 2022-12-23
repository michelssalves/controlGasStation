<?php 
$doc = $_REQUEST['doc'];
$pasta = $_REQUEST['pasta'];

$tipo = explode('.',$doc);

//$raiz = "../../assets/docs/".$pasta."/".$doc; original
$raiz = "../../../medweb/fechamentoCaixa/docs/".$doc;

?>

            <td>
                <form method="POST">
                <input type="hidden" name="p" value="4" required>
                <input type="hidden" name="idAnexo" value="'.$id.'" required>
                <input type="hidden" value="excluirAnexo" name="action" required>
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>   
            </td>
            <embed src="<?=$raiz?>" width="100%" height="100%" />  
    

 


 


