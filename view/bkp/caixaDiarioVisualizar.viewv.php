<!--MODAL VISUALIZAR CX DIÁRIO-->

<div class="modal fade" id="visualizarCaixaDiario" tabindex="-1" aria-labelledby="visualizarCaixaDiarioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header fundo-cabecalho">
      <h1>Visualizar</h1>
        <hr>
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-left">
          <button onmouseenter="mudarTexto1(this.title, this.id)"  onmouseleave="mudarTexto2(this.title,this.id)" id="btn-finalizar-cx" type="button" title="Finalizar Caixa" class="btn btn-primary btn" data-bs-dismiss="modal"><i  class="fa-regular fa-circle-check"></i></button>
          <button type="button" title="Abrir Caixa" class="btn btn-primary btn" data-bs-dismiss="modal"><i class="fa-solid fa-box-open"></i></button>
          <button type="button" title="Editar Caixa" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-solid fa-file-pen"></i></button>
          <button type="button" title="Observação" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-solid fa-eye"></i></button>
          <button type="button" title="Anexo" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-solid fa-paperclip"></i></button>
          <button type="button" title="Cancelar Caixa" class="btn btn-secondary btn" data-bs-dismiss="modal"><i class="fa-regular fa-trash-can"></i></button>
        </div>
        
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
        <button type="button" title="Fechar" class="btn btn-danger btn" data-bs-dismiss="modal"><i class="fa-solid fa-rectangle-xmark"></i></button>
        </div>
      </div>
      <div class="modal-body">
        <form id="visualizarCaixaDiario" method="POST">
          <input type="hidden" id="idRequisicaoVisualizar" type="text">
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Depósito dinheiro:</span>
            <input readonly id="depDinheiroVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <span class="input-group-text" id="inputGroup-sizing">Depósito Cheque:</span>
            <input readonly id="depChequeVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <span class="input-group-text" id="inputGroup-sizing">Depósito Brinks:</span>
            <input readonly id="depBrinksVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Data do Caixa:</span>
            <input readonly id="dataCaixaVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

            <span class="input-group-text" id="inputGroup-sizing">Turno em definitivo:</span>
            <input readonly id="turnosDefinitivoVisualizar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Concialiação bancaria:</span>
            <input readonly id="concVisualizar" name="conc" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <span class="input-group-text" id="inputGroup-sizing">Fechamento caixa geral definitivo:</span>
            <input readonly id="caixaVisualizar" name="caixa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
            <textarea disabled id="obsVisualizar" cols="60" rows="7" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
          </div>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <div class="tabelaCxDiarioAnexos">

              </div>
            </div>
          </div>
          </br>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <div class="tabelaCxDiarioEventos">

              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL VISUALIZAR CX DIÁRIO-->