<!--MODAL VISUALIZAR REQUISICAO-->
    <div class="modal fade w3-animate-top" id="visualizarSolicitacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSolicitacaoModalLabel" aria-hidden="true">
        <form id="formvisualizarSolicitacao" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <input type="hidden" name="status" id="status" :value="status">
                            <input type="hidden" name="idPedido" id="idPedido" :value="idPedido">
                            <div class="p-1" v-if="!(status == 'FINALIZADO' || status == 'CANCELADO' || status == 'NOVO')"><button type="button" title="Confirmar Recebimento" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus(idPedido,'recebido?')"><img class="iconeSize" :src="iconRecebido"></button></div>
                            <div class="p-1" v-if="!(status == 'ENVIADO' || status == 'CANCELADO'|| status == 'FINALIZADO')"><button type="button" title="Enviar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus(idPedido,'enviado?')"><img class="iconeSize" :src="iconEnviado"></button></div>
                            <div class="p-1" v-if="!(status == 'FINALIZADO' || status == 'CANCELADO')"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao()"><img class="iconeSize" :src="iconObs"></button></div>
                            <div class="p-1" v-if="!(status == 'FINALIZADO' || status == 'CANCELADO' || status == 'ENVIADO')"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="cancelarPedido(idPedido)"><img class="iconeSize" :src="iconExc"></button></div>
                            <div class="p-1"><button type="button" @click="fecharModal()" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mt-2">
                                <thead class="header-tabela">
                                    <tr>
                                        <th>DESCRIÇÃO</th>
                                        <th>SOLICITADO</th>
                                        <th>DT ENVIO</th>
                                        <th>DT RECEB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr @click="verItem(solicitacao.item)" data-bs-dismiss="modal" style="cursor:pointer" v-for="(solicitacao, i) in verSolicitacao">
                                        <td>{{solicitacao.desc_produto}}</td>
                                        <td>{{solicitacao.quant}}</td>
                                        <td>{{solicitacao.dataEnvio}}</td>
                                        <td>{{solicitacao.dataRecebimento}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mt-2">
                                <thead class="header-tabela">
                                    <tr>
                                        <th>Data</th>
                                        <th>Obs</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-bs-dismiss="modal" style="cursor:pointer" v-for="(obs, i) in verObservacoes">
                                        <td>{{obs.datahora}}</td>
                                        <td>{{obs.obs}}</td>
                                        <td>{{obs.usuario}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
<!--/MODAL VISUALIZAR REQUISICAO-->