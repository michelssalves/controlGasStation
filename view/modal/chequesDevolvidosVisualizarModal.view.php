<?php include('model/chequesDevolvidosVisualizar.model.php'); ?>

<div class="modal fade" id="<?= $modal ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>DADOS DO CHEQUE</h1>
      </div>
      <div class="modal-body">
        <div class="container col-10">
          <div class="tabela-ver-cheque">
            <table class="table-sm table-striped fs-6">
              <tr>
                <th>STATUS</th>
                <th><?= $status ?></th>
              </tr>
              <tr>
                <th>DATA INCLUSÃO NO SISTEMA</th>
                <th><?= dma($dthrInclusao) ?></th>
              </tr>
              <tr>
                <th>MEDITERRÂNEO</th>
                <th><?= $filial ?></th>
              </tr>
              <tr>
                <th>BANCO</th>
                <th><?= $bco . ' - ' . $vetorBanco[$bco] ?></th>
              </tr>
              <tr>
                <th>NOME DO CORRENTISTA</th>
                <th><?= $nome ?></th>
              </tr>
              <tr>
                <th>NOME DO CLIENTE</th>
                <th><?= $nomeCliente ?></th>
              </tr>
              <tr>
                <th>CPF/CNPJ</th>
                <th><?= $cpfcnpj ?></th>
              </tr>
              <tr>
                <th>TELEFONE PARA CONTATO</th>
                <th><?= $telefone ?></th>
              </tr>
              <tr>
                <th>VALOR DO CHEQUE</th>
                <th><?= v2($valor) ?></th>
              </tr>
              <tr>
                <th>Nº CHEQUE</th>
                <th><?= $nrcheque ?></th>
              </tr>
              <tr>
                <th>MOTIVO</th>
                <th><?= $motivo . ' - ' . $vetorMotivo[$motivo] ?></th>
              </tr>
              <tr>
                <th>DATA CHEQUE</th>
                <th><?= dma($dtCheque) ?></th>
              </tr>
              <tr>
                <th>DATA DEVOLUÇÃO</th>
                <th><?= dma($dtDevol) ?></th>
              </tr>
              <tr>
                <th>DATA QUITAÇÃO</th>
                <th><?= dma($dtQuitacao) ?></th>
              </tr>
              <tr>
                <th>PDV</th>
                <th><?= $pdv ?></th>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="fundo-rodape">
        <div class='d-grid gap-2 d-md-flex mt-4 justify-content-md-center'>
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-sm btn-light">Confirmar Quitação</button>
          <button type="button" class="btn btn-sm btn-light">Sem Solução</button>
          <button type="button" class="btn btn-sm btn-light">Incluir Observação</button>
          <button type="button" class="btn btn-sm btn-light">Incluir Anexo</button>
        </div>
      </div>
    </div>
  </div>
</div>