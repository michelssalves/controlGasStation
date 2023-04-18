<!--MODAL VISUALIZAR DEPOSITOS-->
    <div class="modal fade w3-animate-top" id="visualizarDepositos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerDepositos" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ conta_dep }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id)"><img class="iconeSize" :src="iconObs"></button></div>
                            <div class="p-1"><button type="button" @click="fecharModal()" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Filial:</span>
                            <select disabled id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="id_med" selected>{{ nomecompleto }}</option>
                                <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro:</span>
                            <input disabled id="dinheiro" name="dinheiro" type="text" v-model="dinheiro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                            <input disabled id="cheque" name="cheque" type="text" v-model="cheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Debito:</span>
                            <input disabled id="debito" name="debito" type="text" v-model="debito" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dt Movimento:</span>
                            <input disabled id="dataDep" name="dataDep" type="date" v-model="dataDep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Dt Inclusao:</span>
                            <input disabled id="datahoraReg" name="datahoraReg" type="date" v-model="datahoraReg" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="container">
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>INFO</th>
                                            <th>USUÁRIO</th>
                                            <th>DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="obs in observacoes">
                                            <td>{{ obs.texto }}</td>
                                            <td>{{ obs.usuario }}</td>
                                            <td>{{ obs.datahora }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
<!--/MODAL VISUALIZAR DEPOSITOS-->