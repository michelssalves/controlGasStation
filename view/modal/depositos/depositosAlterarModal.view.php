<!--MODAL ALTERAR DEPÓSITO-->
<div class="modal fade" id="alterarDeposito" tabindex="-1" aria-labelledby="alterarDepositoModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>ALTERAR</h1>
            </div>
            <div class="modal-body">
                <form id="alterarDeposito" method="POST">
                    <input type="hidden" id="actionaAlterar" name="actionaAlterar" value="alterarDeposito">
                    <input type="hidden" id="idDeposito" name="idDeposito" required>
                    <p class="texto-de-advertencia">Se necessário corrija os valores e clique em gravar.</p>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Filial:</span>
                        <input readonly id="loginNameDepositoAlterar" name="loginName" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <span class="input-group-text" id="inputGroup-sizing">Debitos de Clientes:</span>
                        <input readonly id="debitoDepositoAlterar" name="debitos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Dinheiro:</span>
                        <input id="dinheiroDepositoAlterar" name="dinheiro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                        <select required id='contaDepositoAlterar' name='conta' class='form-select' aria-label='Default select example'>
                            <option>CONTA</option>
                            <option>BB</option>
                            <option>BB MEDS</option>
                            <option>BB PROPRIO</option>
                            <option>ITAU</option>
                            <option>BRINKS</option>
                            <option>PROSEGUR</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                        <input id='chequeDepositoAlterar' name="cheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                        <select id='contaChDepositoAlterar' name='contaCh' class='form-select' aria-label='Default select example'>
                            <option>CONTA</option>
                            <option>BB</option>
                            <option>BB MEDS</option>
                            <option>BB PROPRIO</option>
                            <option>ITAU</option>
                            <option>BRINKS</option>
                            <option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Data Devolução:</span>
                        <input id="dataMovimentoDepositoAlterar" name="dataMovimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="table-responsive">
                        <div class="tabelaObsDepositos">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="alterarDeposito(this.form)">Alterar</button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" onclick="incluirObservacao()">Observação</button>
                <button type="submit" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL ALTERAR DEPÓSITO-->