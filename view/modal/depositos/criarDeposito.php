<!--MODAL CRIAR DEPOSITO-->
    <div class="modal fade w3-animate-top" id="criarDeposito" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarDepositoModalLabel" aria-hidden="true">
        <form id="formCriarDeposito" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Criar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarDeposito()" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <input type="hidden" name="action" id="action" v-model="actionCriar">
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro</span>
                            <input @keypress="onlyNumber($event)" name="dinheiro" id="dinheiro" v-model="criarDinheiro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                            <select required v-model="criarConta" name='conta' id='conta' class='form-select' aria-label='Default select example'>
                                <option value="">CONTA</option>
                                <option>BB</option>
                                <option>BB MEDS</option>
                                <option>BB PROPRIO</option>
                                <option>ITAU</option>
                                <option>BRINKS</option>
                                <option>PROSEGUR</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cheque</span>
                            <input @keypress="onlyNumber($event)" name="cheque" id="cheque" v-model="criarCheque" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                            <select required v-model="criarContaCh" name='contaCh' id='contaCh' class='form-select' aria-label='Default select example'>
                                <option value="">CONTA</option>
                                <option>BB</option>
                                <option>BB MEDS</option>
                                <option>BB PROPRIO</option>
                                <option>ITAU</option>
                                <option>BRINKS</option>
                                <option>PROSEGUR</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Data</span>
                            <input name="dataDeposito" id="dataDeposito" v-model="criarData" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Debito de Clientes</span>
                            <input @keypress="onlyNumber($event)" name="debito" id="debito" v-model="criarDebito" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
<!--/MODAL CRIAR DEPOSITO-->