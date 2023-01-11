<!--MODAL VISUALIZAR SERASA-->
<div class="modal fade" id="<?= $modalVisualizar ?>" tabindex="-1" aria-labelledby="serasaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>STATUS SERASA</h1>
      </div>
      <div class="modal-body">
        <form id="<?= $id_requisicao ?>" method="POST">
          <input type="hidden" value="<?= $id_requisicao ?>" name="id_requisicao" required>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Status:</span>
            <input readonly value="<?= $status ?>" name="status" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Documento:</span>
            <input readonly value="<?= $tipo ?>" name="tipo" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
            <input readonly value="<?= $nomeCliente ?>" name="nomeCliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
            <input readonly value="<?= "$cidade / $estado"  ?>" name="cidade" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
            <input readonly value="<?= $bairro  ?>" name="bairro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
            <input readonly value="<?= $cep  ?>" name="cep" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Rua:</span>
            <input readonly value="<?= $endereco ?>" name="endereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dt Nascimento:</span>
            <input readonly value="<?= ($dataNascimento)  ?>" name="dataNascimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">CPF/CNPJ:</span>
            <input readonly value="<?= ($cnpj)  ?>" name="cnpj" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Valor Inicial:</span>
            <input readonly value="<?= v2($valor)  ?>" name="valor" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Valor(Juros):</span>
            <input readonly value="<?= v2(calcularJuros($valor, $dataVencimento))  ?>" name="valorComJuros" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dt Emissão:</span>
            <input readonly value="<?= ($dataEmissao)  ?>" name="dataEmissao" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dt Vencimento:</span>
            <input readonly value="<?= ($dataVencimento)  ?>" name="dataVencimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
            <textarea readonly name="obs" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
          </div>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <table class="table table-hover table-striped fs-6 mb-0">
                <thead class="header-tabela">
                  <tr>
                    <th>Descrição</th>
                    <th>Numero do documento</th>
                  </tr>
                </thead>
                <tbody>
                  <?= selectSerasaAnexos($id_requisicao) ?>
                </tbody>
              </table>
            </div>
          </div>
          </br>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <table class="table table-hover table-striped fs-6 mb-0">
                <thead class="header-tabela">
                  <tr>
                    <th>Data/Hora</th>
                    <th>Usuário</th>
                    <th>Eventos</th>
                  </tr>
                </thead>
                <tbody>
                  <?= selectSerasaEventos($id_requisicao) ?>
                </tbody>
              </table>
            </div>
          </div>
          </br>
          <div class="table-responsive">
            <div class="tabela-ver-todos-os-cheques">
              <table class="table table-hover table-striped fs-6 mb-0">
                <thead class="header-tabela">
                  <tr>
                    <th>Data/Hora</th>
                    <th>Usuário</th>
                    <th>Observações</th>
                  </tr>
                </thead>
                <tbody>
                  <?= selectSerasaObs($id_requisicao) ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
          <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal" onclick="acoesRequisicao(this.form.id, this.form.status.value, this.form.tipo.value, this.form.nomeCliente.value, this.form.valor.value)">Ações</button>
          <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="incluirObservacao(this.form.id)">Observação</button>
          <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal" onclick="incluirAnexo(this.form.id)">Anexos</button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--/MODAL VISUALIZAR SERASA-->