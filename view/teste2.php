<?php
$file = $_REQUEST['file'];

echo "Filename: " . $_FILES['file']['name']."<br>";
echo "Type : " . $_FILES['file']['type'] ."<br>";
echo "Size : " . $_FILES['file']['size'] ."<br>";
echo "Temp name: " . $_FILES['file']['tmp_name'] ."<br>";
echo "Error : " . $_FILES['file']['error'] . "<br>";

if ($_FILES['file']['name'] <> "") {

        $imagem = $_FILES["arquivo"]["tmp_name"];
        $ext = pathinfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION);
        //$token2 = md5(time() . rand(0, 9999) . time());
        $token2 = '1';
        $nome_arquivomax = $token2 . "." . $ext;
        move_uploaded_file($imagem, "../assets/img/imagens/" . $nome_arquivomax);
    
   
    $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
    echo 'deu bom';

}else {
    echo 'deu ruim';
}    