<?php
include('model/chequesDevolvidosVisualizar.model.php');
?>
<div class="modal fade" id="showUserModal" tabindex="-1" aria-labelledby="showUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showUserModalLabel">Show User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertErrorCad"></span>
                    <dl class="row">
                    <table class="table-sm table-striped fs-5 fst-italic">
	<tr>
       <th colspan="2"><center>DADOS DO CHEQUE</th>
	</tr>
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
                    </dl>
                </div>
            </div>
        </div>
    </div>
