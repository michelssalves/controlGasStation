<?php include('model/chequesDevolvidosVisualizar.model.php'); ?>

<div class="modal fade" id="<?= $modal ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        
        <h1>DADOS DO CHEQUE</h1>
      </div>
      <div class="modal-body">
          <div class="tabela-ver-cheque">
          <div class="table-responsive">
    
            <table class="table-sm table-striped fs-6">
              <tr>
                <th colspan="2">STATUS</th>
                <th colspan="3"><?= $status ?></th>
              </tr>
              <tr>
                <th colspan="2">DATA INCLUSÃO NO SISTEMA</th>
                <th colspan="3"><?= dma($dthrInclusao) ?></th>
              </tr>
              <tr>
                <th colspan="2">MEDITERRÂNEO</th>
                <th colspan="3"><?= $filial ?></th>
              </tr>
              <tr>
                <th colspan="2">BANCO</th>
                <th colspan="3"><?= $bco . ' - ' . $vetorBanco[$bco] ?></th>
              </tr>
              <tr>
                <th colspan="2">NOME DO CORRENTISTA</th>
                <th colspan="3"><?= $nome ?></th>
              </tr>
              <tr>
                <th colspan="2">NOME DO CLIENTE</th>
                <th colspan="3"><?= $nomeCliente ?></th>
              </tr>
              <tr>
                <th colspan="2">CPF/CNPJ</th>
                <th colspan="3"><?= $cpfcnpj ?></th>
              </tr>
              <tr>
                <th colspan="2">TELEFONE PARA CONTATO</th>
                <th colspan="3"><?= $telefone ?></th>
              </tr>
              <tr>
                <th colspan="2" >VALOR DO CHEQUE</th>
                <th colspan="3"><?= v2($valor) ?></th>
              </tr>
              <tr>
                <th colspan="2">Nº CHEQUE</th>
                <th colspan="3"><?= $nrcheque ?></th>
              </tr>
              <tr>
                <th colspan="2">MOTIVO</th>
                <th colspan="3"><?= $motivo . ' - ' . $vetorMotivo[$motivo] ?></th>

              </tr>
              <tr>
                <th colspan="2">DATA CHEQUE</th>
                <th colspan="3"><?= dma($dtCheque) ?></th>
              </tr>
              <tr>
                <th colspan="2">DATA DEVOLUÇÃO</th>
                <th colspan="3"><?= dma($dtDevol) ?></th>
              </tr>
              <tr>
                <th colspan="2">DATA QUITAÇÃO</th>
                <th colspan="3"><?= dma($dtQuitacao) ?></th>
              </tr>
              <tr>
                <th colspan="2">PDV</th>
                <th colspan="3"><?= $pdv ?></th>
              </tr>
              <tr>
                  <th class="centralizar fundo-cabecalho" colspan="5">Observações</th>
              </tr>
              <tr>
                  <th colspan="2">Data Hora</th>
                  <th>Usuário</th>
                  <th colspan="2">Observação</th>
              </tr>
              <?php $sql1 = ("SELECT * FROM ccp_chequeDevObs AS Obs WHERE id_cheque =  '".$row['id']."'  ORDER BY datahora"); 
                    $qry1 = odbc_exec($connP, $sql1);
                    //var_dump($sql1);
                    
                    while($row1 = odbc_fetch_array($qry1)){

        echo '<tr>
                  <th colspan="2">'.dmaH($row1['datahora']).'</th>
                  <th>'.$row1['usuario'].'</th>
                  <th colspan="2">'.$row1['obs'].'</th>
              </tr>';
              } 
              ?>
              <tr>
                  <th class="centralizar fundo-cabecalho" colspan="5">Anexos</th>
              </tr>
              <tr>
                  <th colspan="2">Data Hora</th>
                  <th>Usuário</th>
                  <th>Descrição/Nome</th>
                  <th>Tipo</th>
              </tr>
              <?php 
              $sql2 = ("SELECT * FROM ccp_chequeDevAnexo WHERE id_cheque = '".$row['id']."' ORDER BY datahora") ;
              $qry2 = odbc_exec($connP, $sql2);
              //var_dump($sql2);
            
              while($row2 = odbc_fetch_array($qry2)){
              //com esse metodo extract eu posso declarar a variavel direto sem precisar do $row['varivel']    
              extract($row2);

              $link2= "'view/modal/visualizarDocumentosModal.view.php?doc=$id.$tipo&pasta=chequesDevolvidos'";
  
        echo '<tr>
                  <th colspan="2">'.dmaH($row2['datahora']).'</th>
                  <th>'.$row2['usuario'].'</th>
                  <th><a style="cursor:pointer" onclick="abriNovaJanela('.$link2.')">'.$row2['descricao'].'</th>
                  <th>'.$row2['tipo'].'</th>
              </tr>';
              } 
              ?>
              <tr>
                  <th class="centralizar fundo-cabecalho" colspan="5">Eventos</th>
              </tr>
              <tr>
                  <th colspan="2">Data Hora</th>
                  <th>Usuário</th>
                  <th colspan="2">Descrição</th>
              </tr>
              <?php $sql3 = ("SELECT * FROM ccp_chequeDevEventos WHERE id_cheque =  '".$row['id']."'  ORDER BY dthrEvento"); 
                    $qry3 = odbc_exec($connP, $sql3);
                    //var_dump($sql3);
                    while($row3 = odbc_fetch_array($qry3)){

                      
        echo '<tr>
                  <th colspan="2">'.dmaH($row3['dthrEvento']).'</th>
                  <th>'.$row3['usuario'].'</th>
                  <th colspan="2">'.$row3['evento'].'</th>
              </tr>';
              } 
              ?>
            </table>  
            </div>
          </div>
      </div>
      <div class="modal-footer ">      
          <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
          <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#comfirmarQuitacaoModal">Confirmar Quitação</button>
          <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#semSolucaoModal">Sem Solução</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#incluirObservacaoModal">Incluir Observação</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#incluirAnexoModal">Incluir Anexo</button>
          </div>    
        </div>
      </div>

    
  </div>
</div>
<!--MODAL CONFIRMAÇÃO DE QUITAÇÃO-->
<div class="modal fade" id="comfirmarQuitacaoModal" tabindex="-1" aria-labelledby="comfirmarQuitacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>CONFIRMAR QUITAÇÃO?</h3>
                    
                </div>
            </div>    
                <div class="modal-body">
                    <form id="confirmarQuitacaoForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="p" value="2" required>
                    <input type="hidden" value="pfin" name="action">
                      <input type="hidden" name="id_cheque" value="<?= $row['id'] ?>" required>
                        <div class="mb-3">
                              <p class="texto-de-alerta">É OBRIGATÓRIO ANEXAR O DOCUMENTO COMPROVATÓRIO DA EXCLUSÃO NO SPC</p> 
                            <label for="file" class="col-form-label">Comprovante:</label>
                            <input type="file" name="file" class="form-control" id="file" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#<?= $modal ?>">Fechar</button>
                            <button type="submit" class="btn btn-outline-success btn-sm">Confirmar Quitação?</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL CONFIRMAÇÃO DE QUITAÇÃO--> 
<!--MODAL SEM SOLUÇÃO-->
<div class="modal fade" id="semSolucaoModal" tabindex="-1" aria-labelledby="semSolucaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>SEM SOLUÇÃO</h3>
                    
                </div>
            </div>    
                <div class="modal-body">
                    <form id="semSolucaoForm" method="POST">
                    <input type="hidden" name="p" value="2" required>
                    <input type="hidden" value="semsolucao" name="action">
                      <input type="hidden" name="id_cheque" value="<?= $row['id'] ?>" required>
                        <div class="mb-3">
                          <p class="texto-de-alerta">ESCREVA O MOTIVO DO CANCELAMENTO</p>
                            <label for="email" class="col-form-label">Justificativa:</label>
                            <textarea name="observacao" cols="50" lines="5" style="white-space: pre;"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#<?= $modal ?>">Fechar</button>
                            <button type="button" class="btn btn-outline-danger btn-sm" onClick="this.form.submit()">Sem solução</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL SEM SOLUÇÃO-->
<!--MODAL INCLUIR OBSERVAÇÃO-->
<div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>INCLUIR OBSERVAÇÃO</h3>
                    
                </div>
            </div>    
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                    <input type="hidden" name="p" value="2" required>
                      <input type="hidden" name="id_cheque" value="<?= $row['id'] ?>" required>
                       <input type="hidden" value="gravaObs" name="action">
                        <div class="mb-3">
                          <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA ATUALIZAÇÃO SOBRE ESTE CLIENTE</p>
                            <textarea name="obs" cols="50" lines="5" style="white-space: pre;"></textarea>
                            <input type="checkbox" name="enviarEmail" id="enviarEmail">Enviar notificaçao por email&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#<?= $modal ?>">Fechar</button>
                            <button type="button" class="btn btn-outline-success btn-sm" onClick="this.form.submit()">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR OBSERVAÇÃO-->
<!--MODAL INCLUIR ANEXO-->
<div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                <div class="modal-header">
                  <h3>INCLUIR ANEXO</h3>
                </div>
            </div>    
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="p" value="2" required>
                      <input type="hidden" name="id_cheque" value="<?= $row['id'] ?>" required>
                      <input type="hidden" value="gravarAnexo" name="action" required>
                        <div class="mb-3">
                          <p class="texto-de-advertencia">AQUI SERÁ INCLUIDO TODA A DOCUMENTAÇÃO REFERENTE A ESTE CLIENTE</p>
                            <label  for="descricao" class="col-form-label">Descrição:</label>
                            <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Titulo para o arquivo" required>
                            <label for="descricao" class="col-form-label">Comprovante:</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#<?= $modal ?>">Fechar</button>
                            <button type="submit" class="btn btn-outline-success btn-sm">Incluir Anexo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR ANEXO-->