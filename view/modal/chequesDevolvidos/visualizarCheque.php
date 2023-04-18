    <!--MODAL VISUALIZAR CHEQUE-->
    <div class="modal fade w3-animate-top" id="visualizarCheque" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerCheque" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status != 'CANCELADO'" class="d-flex flex-row">
                                <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="PFIN" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="statusPfin(id)"><img class="iconeSize" :src="iconPfin"></button></div>
                                <div v-if="status == 'PFIN'" class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalQuitar(id)"><img class="iconeSize" :src="iconFinalizar"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id)"><img class="iconeSize" :src="iconObs"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id)"><img class="iconeSize" :src="iconAnx"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(id)"><img class="iconeSize" :src="iconExc"></button></div>
                            </div>
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
                            <input disabled id="loginName" name="loginName" type="text" v-model="loginName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                            <input disabled id="banco" name="banco" type="text" v-model="banco" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
                            <input disabled id="nome" name="nome" type="text" v-model="nome" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">CNPJ:</span>
                            <input disabled id="cpfcnpj" name="cpfcnpj" type="text" v-model="cpfcnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Telefone:</span>
                            <input disabled id="telefone" name="telefone" type="text" v-model="telefone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Nº Cheque:</span>
                            <input disabled id="nrcheque" name="nrcheque" type="text" v-model="nrcheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor:</span>
                            <input disabled id="valor" name="valor" type="text" v-model="valor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Qui:</span>
                            <input disabled id="dtQuitacao" name="dtQuitacao" type="date" v-model="dtQuitacao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Motivo:</span>
                            <input disabled id="motivo" name="motivo" type="text" v-model="motivo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dt Cri:</span>
                            <input disabled id="dthrInclusao" name="dthrInclusao" type="date" v-model="dthrInclusao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Chq:</span>
                            <input disabled id="dtCheque" name="dtCheque" type="date" v-model="dtCheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Dev:</span>
                            <input disabled id="dtDevol" name="dtDevol" type="date" v-model="dtDevol" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="container">
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>OBS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="observacao in observacoes">
                                            <td>{{observacao.datahora}}</td>
                                            <td>{{observacao.usuario}}</td>
                                            <td>{{observacao.obs}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>DESCRICÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="newTab(anexo.idAnexo)" style="cursor:pointer" v-for="anexo in anexos">
                                            <td>{{anexo.datahora}}</td>
                                            <td>{{anexo.usuario}}</td>
                                            <td>{{anexo.descricao}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>DESCRICÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="evento in eventos">
                                            <td>{{evento.datahora}}</td>
                                            <td>{{evento.usuario}}</td>
                                            <td>{{evento.evento}}</td>
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
    <!--/MODAL VISUALIZAR CHEQUE-->