    <!--MODAL VISUALIZAR PAGAMENTOS-->
    <div class="modal fade w3-animate-top" id="visualizarPagamentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerPagamentos" method="POST">
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
                            <div class="p-1"><button type="button" title="Finalizar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus('FINALIZADO')"><img class="iconeSize" :src="iconFinalizar"></button></div>
                            <div class="p-1"><button type="button" title="Aguardando" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus('AGUARDANDO')"><img class="iconeSize" :src="iconAguarde"></button></div>
                            <div class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus('CANCELADO')"><img class="iconeSize" :src="iconCancelar"></button></div>
                            <div class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id)"><img class="iconeSize" :src="iconObs"></button></div>
                            <div class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id)"><img class="iconeSize" :src="iconAnx"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" class="btn btn-sm" @click="fecharModal()" id="botaoFechar" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
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
                            <input disabled id="med" name="med" type="text" v-model="med" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Usuario:</span>
                            <input disabled id="apelido" name="apelido" type="text" v-model="apelido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Fornecedor:</span>
                            <input disabled id="fornecedor" name="fornecedor" type="text" v-model="fornecedor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
                            <input disabled id="descricao" name="descricao" type="text" v-model="descricao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Vencimento:</span>
                            <input disabled id="vencimento" name="vencimento" type="text" v-model="vencimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor:</span>
                            <input disabled id="valor" name="valor" type="text" v-model="valor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <input disabled id="obs" name="obs" type="text" v-model="obs" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="container">
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>ANEXO</th>
                                            <th>USUÁRIO</th>
                                            <th>DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="newTab(anexo.idAnexo,anexo.extensao)" style="cursor:pointer" v-for="anexo in anexos">
                                            <td>{{anexo.descricao }}</td>
                                            <td>{{anexo.usuario }}</td>
                                            <td>{{anexo.datahora }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                            <td>{{obs.obs }}</td>
                                            <td>{{obs.usuario }}</td>
                                            <td>{{obs.datahora }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL VISUALIZAR PAGAMENTOS-->