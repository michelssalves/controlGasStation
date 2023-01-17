<!--MODAL VISUALIZAR/ALTERAR RM-->
<div class="modal fade bd-example-modal-lg" id="requisicaoMaterial" tabindex="-1" aria-labelledby="requisicaoMaterialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>ALTERAR REQUISIÇÃO</h1>
      </div>
      <div class="modal-body">
          <div class="table-responsive">
            <div class="tabelaRM">

            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
          <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="acoesRequisicao(this.form.id, this.form.status.value, this.form.tipo.value, this.form.nomeCliente.value, this.form.valor.value)">Incluir</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--MODAL VISUALIZAR/ALTERAR RM-->