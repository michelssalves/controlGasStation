<!--MODAL VISUALIZAR CHEQUES-->
  <div class="modal fade" id="visualizarChequeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="fundo-cabecalho">
          <h1>VISUALIZAR</h1>
        </div>
        <div class="modal-body">
        <div class="table-responsive">
            <div class="tabelaCheques">

            </div>
          </div>
        </div>
        <div class="modal-footer ">
          <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
            <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="confirmarQuitacao()">Quitar</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" onclick="confirmarPfin()">PFIN</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" onclick="cancelarCheque()">Cancelar</button>
            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" onclick="incluirObservacao()">Observação</button>
            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" onclick="anexarArquivo()">Anexo</button>
            <button type="submit" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--MODAL VISUALIZAR CHEQUES-->