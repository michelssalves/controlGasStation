  <!--MODAL INCLUIR  VER CLASSES-->
  <div class="modal fade bd-example-modal-lg" id="cadastrarClasseEstoque" tabindex="-1" aria-labelledby="cadastrarClasseEstoqueModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="fundo-cabecalho">
          <h1>CADASTRAR</h1>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="input-group input-group-sm mb-3 ">
              <span class="input-group-text" id="inputGroup-sizing">Classe:</span>
              <input id="classeCad" name="classeCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="cadastrarClasse(this.form.classeCad.value)">Incluir</button>
            </div>
            <div class="table-responsive">
              <div class="tabelaClasses">

              </div>
            </div>
        </div>
        <div class="modal-footer">
          <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="verEstoque()">Fechar</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!--MODAL INCLUIR  VER CLASSES-->