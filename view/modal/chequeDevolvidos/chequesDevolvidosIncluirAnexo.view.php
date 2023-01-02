<!--MODAL INCLUIR ANEXO OK-->
<div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="fundo-cabecalho">
                  <h1>INCLUIR ANEXO</h1>
            </div>    
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="p" value="2" required>
                      <input type="hidden" id="id_anexo" name="idCheque" value="" required>
                      <input type="hidden" value="gravarAnexo" name="action" required>
                        <div class="mb-3">
                          <p class="texto-de-advertencia">AQUI SERÁ INCLUIDO TODA A DOCUMENTAÇÃO REFERENTE A ESTE CLIENTE</p>
                            <label  for="descricao" class="col-form-label">Descrição:</label>
                            <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Titulo para o arquivo" required>
                            <label for="descricao" class="col-form-label">Comprovante:</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-success btn-sm">Incluir Anexo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
<!--/MODAL INCLUIR ANEXO-->
