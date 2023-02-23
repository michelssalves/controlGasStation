<?php
include('model/SolicitacaoDePagamento.php');
include('controller/solicitacaoDePagamento.php');
?>
<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROSDA LINHA 6 ATÉ 89-->
    <form method='POST' id='formFiltroPagamentos'>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-2 p-1">
                    <input @keyup="getPagamentos('filtrar')" @mouseleave="getPagamentos()" class='form-control' type='date' id='data1' name="data1">
                </div>
                <div class="col-md-2 p-1">
                    <input @keyup="getPagamentos('filtrar')" @mouseleave="getPagamentos()" class='form-control' type='date' id='data2' name="data2">
                </div>
                <div class="col-md-2 p-1">
                    <div class="dropdown">
                        <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input @click="getPagamentos('filtrar')" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input @click="getPagamentos('filtrar')" type="checkbox" id="statusPendente" name="statusPendente" value="PENDENTE" /> PENDENTE</label></li>
                            <li><input @click="getPagamentos('filtrar')" type="checkbox" id="statusAguardando" name="statusAguardando" value="AGUARDANDO" /> AGUARDANDO</label></li>
                            <li><input @click="getPagamentos('filtrar')" type="checkbox" id="statusFinalizado" name="statusFinalizado" value="FINALIZADO" /> FINALIZADO</label></li>
                            <li><input @click="getPagamentos('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 p-1"><input @keypress="getPagamentos()" class='form-control' type='text' id='fornecedor' name="fornecedor" placeholder="Fornecedor">
                </div>
                <div class="col-md-2 p-1">
                    <select @change="getPagamentos('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="0">Filial</option>
                        <option v-for="med in meds" :key="med.id" :value="med.nomecompleto">{{ med.nomecompleto }}</option>
                    </select>
                </div>
                <div class="col-md-1 p-1 mt-1">
                    <button type="button" class='btn btn-danger btn-sm' @click="limparFiltros()">Limpar</button>
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
        <div class="table-responsive">
            <table class="table table-striped table-hover mt-1 ">
                <thead class="header-tabela">
                    <tr>
                        <th>ID</th>
                        <th>FILIAL</th>
                        <th>USUARIO</th>
                        <th>FORNECEDOR</th>
                        <th>STATUS</th>
                        <th>VCTO</th>
                        <th>VALOR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr @click="modalVisualizar(pagamento.idReq)" style="cursor:pointer" v-for="(pagamento, i) in pagamentos">
                        <td>{{pagamento.idReq}}</td>
                        <td>{{pagamento.med}}</td>
                        <td>{{pagamento.apelido}}</td>
                        <td>{{pagamento.fornecedor}}</td>
                        <td>{{pagamento.status}}</td>
                        <td>{{pagamento.vencimento}}</td>
                        <td>{{pagamento.valor}}</td>
                    </tr>
                </tbody>
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
    </form>
    <!--AREA ONDE ESTÁ A TABELA E FILTROSDA LINHA 6 ATÉ 89-->
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
                            <div class="p-1"><button type="button" title="Finalizar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="finalizar(idReq)"><img class="iconeSize" :src="iconFinalizar"></button></div>
                            <div class="p-1"><button type="button" title="Aguardando" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="aguardando(idReq)"><img class="iconeSize" :src="iconAguarde"></button></div>
                            <div class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(idReq)"><img class="iconeSize" :src="iconObs"></button></div>
                            <div class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(idReq)"><img class="iconeSize" :src="iconAnx"></button></div>
                            <div class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(idReq)"><img class="iconeSize" :src="iconExc"></button></div>
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
                            <input id="idReq" name="idReq" type="hidden" v-model="idReq" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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
</div>
<!--FIM DIV APP VUE JS-->