    <!--MODAL VISUALIZAR PAGAMENTOS-->
    <div class="modal fade" id="visualizarPagamentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerPagamentos" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-light rounded-circle text-dark fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-light rounded-circle text-dark fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status == 'CANCELADO' || status == 'BAIXADO'" class="p-1"><button type="button" title="PFIN" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                            <div class="d-flex flex-row" v-if="status != 'BAIXADO'">
                                <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="Pfin" class="btn btn-light btn-sm" :disabled="disabled" data-bs-dismiss="modal" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                                <div v-if="status == 'PEFIN'" class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" :disabled="disabled" data-bs-dismiss="modal" @click="modalBaixado(id_requisicao)"><img class="iconeSize" :src="iconQuitar"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" :title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm" @click="aplicarIcon ? salvarAlteracoes(id_requisicao) : '' "><img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title" :src="aplicarIcon ? iconEdit : iconSave" /></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button></div>
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
                            <input id="id_requisicao" name="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CPF/CNPJ:</span>
                            <input disabled id="cnpj" name="cnpj" type="text" v-model="cnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
                            <input disabled id="cliente" name="cliente" type="text" v-model="cliente" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="container">
                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-striped table-hover mt-2">
                                        <thead class="header-tabela">
                                            <tr>
                                                <th>ANEXO</th>
                                                <th>USUÁRIO</th>
                                                <th>DATA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr @click="newTab(anexo.id)" style="cursor:pointer" v-for="anexo in anexos">

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>INFO</th>
                                            <th>USUÁRIO</th>
                                            <th>DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="evento in eventos">

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
    <!--/MODAL VISUALIZAR PAGAMENTOS-->