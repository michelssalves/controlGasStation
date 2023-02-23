<?php
include('model/EnviarMateriais.php');
include('controller/enviarMateriais.php');
?>
<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA COM FILTROS LINHA -->
    <form method='POST' id='formFiltroSolicitacoes'>
        <div class="container text-center p-2">
            <div class="row">
                <div class="col-md-3 p-1">
                    <div class="dropdown">
                        <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input @click="getSolicitacoes()" class="ml-3" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input @click="getSolicitacoes()" class="ml-3" type="checkbox" id="statusEnviado" name="statusEnviado" value="ENVIADO" /> ENVIADO</label></li>
                            <li><input @click="getSolicitacoes()" class="ml-3" type="checkbox" id="statusFinalizado" name="statusFinalizado" value="FINALIZADO" /> FINALIZADO</label></li>
                            <li><input @click="getSolicitacoes()" class="ml-3" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 p-1">
                    <select @change="getSolicitacoes()" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="0">Filial</option>
                        <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                    </select>
                </div>
                <div class="col-md-3 p-1">
                    <input @keyup="getSolicitacoes()" type="text" class='form-control' id="produto" name="produto" placeholder="Produto">
                </div>
                <div class="col-md-2 mt-2">
                    <button type="button" class='btn btn-danger btn-sm' @click="limparFiltros()">Limpar</button>
                    <button type="button" class='btn btn-primary btn-sm'>Estoque</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="fundo-header-tabelas d-flex justify-content-center">
            <div v-show="message.length > 0" class="text-dark fs-6 ">
                <h4>{{message}}</h4>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class='table table-striped table-hover mt-1'>
            <thead class="header-tabela">
                <tr>
                    <th>Filial</th>
                    <th>Dt Ped</th>
                    <th>Dt Fec</th>
                    <th>Obs</th>
                    <th>Itens Total</th>
                    <th>Itens Parcial</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="modalVisualizarSolicitacao(solicitacao.id_pedido)" style="cursor:pointer" v-for="solicitacao in solicitacoes">
                    <td>{{solicitacao.loginName}}</td>
                    <td>{{solicitacao.dataPedido}}</td>
                    <td>{{solicitacao.dataEntrega}}</td>
                    <td>{{solicitacao.lista}}</td>
                    <td>{{solicitacao.itens}}</td>
                    <td>{{solicitacao.itens_parcial}}</td>
                    <td>{{solicitacao.status}}</td>
                </tr>
            <tbody>
        </table>
        <nav aria-label="Page navigation example" style="cursor:pointer">
            <ul class="pagination pagination-sm justify-content-center">
                <li class="page-item">
                    <a class="page-link" @click="paginaAtual = 1">Primeira</a>
                </li>
                <li class="page-item" v-if="paginaAtual - 1 > 0" @click="paginaAtual--">
                    <a class="page-link">{{paginaAtual - 1}}</a>
                </li>
                <li class="page-item active">
                    <a class="page-link">{{ paginaAtual }}</a>
                </li>
                <li class="page-item" v-if="paginaAtual + 1 <= totalResults" @click="paginaAtual++">
                    <a class="page-link">{{paginaAtual + 1}}</a>
                </li>
                <li class="page-item">
                    <a class="page-link" @click="paginaAtual = totalResults">Ultima</a>
                </li>
            </ul>
        </nav>
    </div>
    <!--MODAL VISUALIZAR CX DIÁRIO-->
    <div class="modal fade" id="visualizarSolicitacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSolicitacaoModalLabel" aria-hidden="true">
        <form id="formvisualizarSolicitacao" method="POST">
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
                            <input type="hidden" name="status" id="status" :value="status">
                            <input type="hidden" name="idPedido" id="idPedido" :value="idPedido">
                            <div class="p-1" v-if="!(status == 'FINALIZADO' || status == 'CANCELADO' || status == 'NOVO')"><button type="button" title="Confirmar Recebimento" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus(idPedido)"><img class="iconeSize" :src="iconRecebido"></button></div>
                            <div class="p-1" v-if="!(status == 'ENVIADO' || status == 'CANCELADO'|| status == 'FINALIZADO')"><button type="button" title="Enviar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="alterarStatus(idPedido)"><img class="iconeSize" :src="iconEnviado"></button></div>
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
    <!--/MODAL VISUALIZAR CX DIÁRIO-->
    <!--MODAL INCLUIR OBSERVAÇÃO-->
    <div class="modal fade" id="incluirObservacaoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <form id="incluirObservacaoForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Observação</h2>
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                            <button type="button" title="Fechar" @click="modalVisualizarSolicitacao(idPedido)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input name="idPedido" id="idPedido" type="text" v-model="idPedido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVAÇÃO SOBRE ESTA SOLICITAÇÃO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="observacao" id="observacao" v-model="observacao" cols="60" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" v-show="observacao.length > 10" @click="salvarObservacao(idPedido)" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR OBSERVAÇÃO-->
    <!--MODAL CANCELAR-->
    <div class="modal fade" id="modalCancelarSolicitacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelarSolicitacaoModalLabel" aria-hidden="true">
        <form id="formCancelamento" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Cancelamento</h2>
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                            <button type="button" title="Fechar" @click="modalVisualizarSolicitacao(idPedido)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="idPedido" type="hidden" v-model="idPedido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI O MOTIVO DO CANCELAMENTO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="motivoCancelamento" id="motivoCancelamento" v-model="motivoCancelamento" cols="60" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" v-show="motivoCancelamento.length > 10" @click="salvarCancelamento()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--MODAL CANCELAR-->
    <!--MODAL VISUALIZAR ITEM-->
    <div class="modal fade" id="modalvisualizarItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarItemModalLabel" aria-hidden="true">
        <form id="formVisualizarItem" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Alterar</h2>
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                            <div class=""><button type="button" @click="salvarQtdes(idPedido)" title="Salvar" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class=""><button type="button" @click="cancelarItem(idPedido)" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconExc"></button></div>
                            <div class=""><button type="button" @click="modalVisualizarSolicitacao(idPedido)" title="Fechar" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input name="idPedido" id="idPedido" type="hidden" v-model="idPedido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input name="idItem" id="idItem" type="hidden" v-model="idItem" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
                            <input disabled type="text" v-model="produto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Quantidade:</span>
                            <input id="quantidade" name="quantidade" type="text" v-model="quantidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--MODAL VISUALIZAR ITEM-->

</div>
<!--FIM DIV APP VUE JS-->