<?php
include('model/Depositos.php');
include('controller/depositos.php');
?>
<div id="app">
    <form method='POST' id='formularioDepositos'>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-2 p-1">
                    <select @change="getDepositos('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="0">Filial</option>
                        <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <select @change="getDepositos('filtrar')" required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                        <option value="CONTA">CONTA</option>
                        <option>BB</option>
                        <option>BB MEDS</option>
                        <option>BB PROPRIO</option>
                        <option>ITAU</option>
                        <option>BRINKS</option>
                        <option>PROSEGUR</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <input @keyup="getDepositos('filtrar')" @mouseleave="getDepositos('filtrar')" type='date' class='form-control' name='data1' id='data1'>
                </div>
                <div class="col-md-2 p-1">
                    <input @keyup="getDepositos('filtrar')" @mouseleave="getDepositos('filtrar')" type='date' class='form-control' name='data2' id='data2'>
                </div>
                <div class="col-md-1 p-1 mt-1">
                    <button @click="limparFiltros()" type="button" class='btn btn-danger btn-sm'>Limpar</button>
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
    <div class="table-wrapper">
        <table class="table table-striped table-hover mt-1 ">
            <thead class="header-tabela">
                <tr>
                    <th>DT MOV</th>
                    <th>DIA SEM</th>
                    <th>MED</th>
                    <th>DINHEIRO</th>
                    <th>CONTA DIN</th>
                    <th>CHEQUE</th>
                    <th>CONTA CH</th>
                    <th>TOTAL DEP</th>
                    <th>DÉBITO</th>
                    <th>DT REG</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="modalVisualizar(deposito.id)" v-for="deposito in depositos">
                    <td>{{deposito.dataMovimento}}</td>
                    <td>{{deposito.dataMovimento}}</td>
                    <td>{{deposito.loginName}}</td>
                    <td>{{deposito.dinheiro | duasCasasDecimais}}</td>
                    <td>{{deposito.conta}}</td>
                    <td>{{deposito.cheque | duasCasasDecimais}}</td>
                    <td>{{deposito.contaCh | duasCasasDecimais}}</td>
                    <td>{{deposito.ttdep | duasCasasDecimais}}</td>
                    <td>{{deposito.debito | duasCasasDecimais}}</td>
                    <td>{{deposito.dataRegistro}}</td>
                </tr>
            </tbody>
        </table>
    </div>
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
    <!--MODAL VISUALIZAR DEPOSITOS-->
    <div class="modal fade" id="visualizarDepositos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerDepositos" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-light rounded-circle text-dark fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-light rounded-circle text-dark fs-6">{{ conta_dep }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="Pfin" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalParaPfin(id)"><img class="iconeSize" :src="iconCxFechado"></button></div>
                            <div class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalQuitar(id)"><img class="iconeSize" :src="iconFinalizar"></button></div>
                            <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id)"><img class="iconeSize" :src="iconObs"></button></div>
                            <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id)"><img class="iconeSize" :src="iconAnx"></button></div>
                            <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(id)"><img class="iconeSize" :src="iconExc"></button></div>
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
    <!--/MODAL VISUALIZAR DEPOSITOS-->
    <!--MODAL INCLUIR ANEXO OK-->
    <div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Anexar</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" @click="voltarVisualizar(id)" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input id="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="container">
                                <div v-if="files.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(file, key) in files" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ file.name }}
                                    <div class="success-container" v-if="file.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFile(key)"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="button" class="btn btn-success btn-sm" v-on:click="salvarAnexo('salvarAnexo')" v-show="files.length > 0">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL INCLUIR ANEXO-->
    <!--MODAL INCLUIR OBSERVAÇÃO-->
    <div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <form id="incluirObservacaoForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Observação</h2>
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                            <button type="button" @click="voltarVisualizar(id)" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVAÇÃO SOBRE ESTE PEDIDO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="observacao" id="observacao" v-model="observacao" cols="60" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" v-show="observacao.length > 10" @click="salvarObs()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR OBSERVAÇÃO-->
    <!--MODAL CANCELAR-->
    <div class="modal fade" id="modalCancelarCaixa" tabindex="-1" aria-labelledby="cancelarCaixaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Cancelamento</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" @click="voltarVisualizar(id)" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formCancelamento" method="POST">
                        <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI O MOTIVO DO CANCELAMENTO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="motivoCancelamento" id="motivoCancelamento" v-model="motivoCancelamento" cols="60" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" v-show="motivoCancelamento.length > 10" @click="salvarCancelamento()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL CANCELAR-->
       <!--MODAL QUITAR-->
       <div class="modal fade" id="modalQuitarCheque" tabindex="-1" aria-labelledby="quitarChequeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Anexar</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" @click="voltarVisualizar(id)" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input id="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                          
                            <div class="container">
                            <p><strong>Anexar comprovante para confirmar quitação</strong></p>
                                <div v-if="files.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(file, key) in files" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ file.name }}
                                    <div class="success-container" v-if="file.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFile(key)"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="button" class="btn btn-success btn-sm" v-on:click="salvarAnexo('quitarCheque')" v-show="files.length > 0">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL QUITAR-->
</div>