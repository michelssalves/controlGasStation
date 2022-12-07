<?php include('model/chequesDevolvidosVisualizar.model.php'); ?>

<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4 align-middle" id="exampleModalLabel">DADOS DO CHEQUE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table-sm table-striped fs-6 fst-italic">
    <tr>
        <th>STATUS</th>
        <th><?=$status?></th>
    </tr> 
    <tr>
        <th>DATA INCLUSÃO NO SISTEMA</th>
        <th><?=dma($dthrInclusao)?></th>
    </tr>  
    <tr>
        <th>MEDITERRÂNEO</th>
        <th><?=$filial?></th>
    </tr> 
    <tr>
        <th>BANCO</th>
        <th><?=$bco.' - '.$vetorBanco[$bco]?></th>
    </tr> 
    <tr>
        <th>NOME DO CORRENTISTA</th>
        <th><?=$nome?></th>
    </tr> 
    <tr>
        <th>NOME DO CLIENTE</th>
        <th><?=$nomeCliente?></th>
    </tr> 
    <tr>
        <th>CPF/CNPJ</th>
        <th><?=$cpfcnpj?></th>
    </tr> 
    <tr>
        <th>TELEFONE PARA CONTATO</th>
        <th><?=$telefone?></th>
    </tr> 
    <tr>
        <th>VALOR DO CHEQUE</th>
        <th><?=v2($valor)?></th>
    </tr> 
    <tr>
        <th>Nº CHEQUE</th>
        <th><?=$nrcheque?></th>
    </tr> 
    <tr>
        <th>MOTIVO</th>
        <th><?=$motivo.' - ' .$vetorMotivo[$motivo] ?></th>
    </tr> 
    <tr>
        <th>DATA CHEQUE</th>
        <th><?=dma($dtCheque)?></th>
    </tr> 
    <tr>
        <th>DATA DEVOLUÇÃO</th>
        <th><?=dma($dtDevol)?></th>
    </tr> 
    <tr>
        <th>DATA QUITAÇÃO</th>
        <th><?=dma($dtQuitacao)?></th>
    </tr>  
    <tr>
        <th>PDV</th>
        <th><?=$pdv?></th>
    </tr> 
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>