    <!--MODAL OBSERVAÇÕES-->
    <div class="modal fade w3-animate-top" id="dadosObservacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosObservacaoModalLabel" aria-hidden="true">
        <form id="formDadosObservacao" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Observações</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1">
                                <button type="button" title="Dados Cadastrais" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosCadastrais')"><img class="iconeSize" :src="iconCadastro"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Financeiro" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosFinanceiros')"><img class="iconeSize" :src="iconFinanceiro"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Veiculos" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosVeiculos')"><img class="iconeSize" :src="iconTruck"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Documentos" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosDocumentos')"><img class="iconeSize" :src="iconAnx"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Observacões" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosObservacao')"><img class="iconeSize" :src="iconObs"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Eventos" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosEventos')"><img class="iconeSize" :src="iconEventos"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container text-center">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col">
                                    <button type="button" title="Observação Adc" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="abrirModal('criarObservacao')"><img class="iconeSize" :src="iconCreate"></button>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="fundo-header-tabelas d-flex justify-content-center">
                                <div v-show="message.length > 0" class="text-dark fs-6 ">
                                    <h4>{{message}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover mt-2">
                                <thead class="header-tabela">
                                    <tr>
                                        <th>OBSERVAÇÃO</th>
                                        <th>DATA</th>
                                        <th>USUÁRIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor:pointer" v-for="obs in observacoes">
                                        <td>{{obs.obs}}</td>
                                        <td>{{obs.datahora}}</td>
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
    <!--/MODAL OBSERVAÇÕES-->