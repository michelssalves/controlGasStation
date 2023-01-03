<form method="POST">
  <?php
  session_start();

  $id_requisicao = $_REQUEST['id_requisicao'];
  $doc = $_REQUEST['doc'];
  $pasta = $_REQUEST['pasta'];
  $descricao = $_REQUEST['descricao'];
  $pasta = $_REQUEST['pasta'];

  list($idArquivo, $extensao) = explode(".", $doc);

  //$raiz = "../../assets/docs/".$pasta."/".$doc; original
  $raiz = "../../../medweb/fechamentoCaixa/docs/" . $doc;
  $raiz2 = "../../assets/docs/FechamentoCaixa/367539.pdf";
  ?>

  <head>
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-auto ">
          <button value="excluirAnexo" name="action" type="submit" class="btn btn-danger btn-lg">Excluir</button>
        </div>
      </div>
    </div>
    <input type="hidden" name="raiz2" value="<?= $raiz2 ?>">
    <input type="hidden" name="id_requisicao" value="<?= $id_requisicao ?>">
    <input type="hidden" name="idArquivo" value="<?= $idArquivo ?>">
    <input type="hidden" name="extensao" value="<?= $extensao ?>">
    <input type="hidden" name="descricao" value="<?= $descricao ?>">

    <form>
      <?php if ($extensao == 'pdf' || $extensao == 'PDF') { ?>
        <embed src="<?= $raiz ?>" width="100%" height="100%" />
      <?php } else { ?>
        <iframe src="<?= $raiz ?>" width="100%" height="100%" id="iframe1" marginheight="0" frameborder="0" onLoad="autoResize('iframe1');">
        </iframe>
      <?php } ?>
      <script src="../../assets/js/bootstrap.bundle.min.v5.2.3.js"></script>
  </body>
  <?php

  $action = $_REQUEST['action'];

  if ($action == 'excluirAnexo') {

    include('../../controller/controllerAux/validaLogin.php');
    include('../../model/CaixaDiario.php');

    $raiz2 = $_REQUEST['raiz2'];
    $idArquivo = $_REQUEST['idArquivo'];
    $extensao = $_REQUEST['extensao'];
    $doc = $_REQUEST['doc'];
    $descricao = $_REQUEST['descricao'];
    $id_requisicao = $_REQUEST['id_requisicao'];
    $usuarioLogado;
    $obs = "EXCLUIU UM ANEXO: $descricao - $doc";

    echo deleteFechamentoCaixaAnexo($idArquivo);

    echo insertFechamentoCaixaObservacao($id_requisicao, $usuarioLogado, $obs);

    unlink($raiz2);
  }

  ?>