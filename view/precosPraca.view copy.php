<?php
include('model/PrecosPraca.php');
include('controller/precosPraca.php');
?>
<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroPagamentos'>
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="modalCadastrarConcorrente()"><img class="iconeSize" :src="iconCreate"></button>
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
                <table class="table table-striped table-hover mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>BANDEIRA</th>
                            <th>DIST</th>
                            <th>GASOL C</th>
                            <th>GASOL C ADIT</th>
                            <th>ETANOL</th>
                            <th>DIESEL C</th>
                            <th>DIESEL S10</th>
                            <th>GNV</th>
                            <th>DATA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(concorrente.cid)" style="cursor:pointer" v-for="concorrente in concorrentes">
                            <td>{{ concorrente.cid }}</td>
                            <td>{{ concorrente.nome }}</td>
                            <td>{{ concorrente.bandeira }}</td>
                            <td>{{ concorrente.distancia }}</td>
                            <td>{{ concorrente.preco_GasC | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_GasCAdit | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_etanol | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_Diesel | quatroCasasDecimais }}</td>
                            <td>{{ concorrente.preco_DieselAdit | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_GNV | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.dataAtu }}</td>
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
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
    <!--MODAL CRIAR CONCORRENTE-->
    <div class="modal fade w3-animate-top" id="cadastrarConcorrente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarCaixaModalLabel" aria-hidden="true">
        <form id="formCadastrarConcorrente" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Cadastrar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarConcorrente()" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave" /></button></div>
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
                            <input id="action" name="action" v-model='actionCadastrar' type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Nome:</span>
                                <input id="razaoSocial" name="razaoSocial" v-model='razaoSocial' type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bandeira:</span>
                                <select required id='bandeira' name='bandeira' v-model='bandeira' class='form-select' aria-label='Default select example'>
                                    <option selected>BANDEIRA</option>
                                    <option>RDP</option>
                                    <option>BRANCA</option>
                                    <option>PETROBRAS</option>
                                    <option>IPIRANGA</option>
                                    <option>SHELL</option>
                                    <option>POTENCIAL</option>
                                    <option>ALE</option>
                                    <option>LATINA</option>
                                    <option>ESSO</option>
                                    <option>TEXACO</option>
                                    <option>OUTRA</option>
                                </select>
                                <span class="input-group-text" id="inputGroup-sizing">Distancia:</span>
                                <input @keypress="onlyNumber($event)" id="distancia" name="distancia" v-model="distancia" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cep:</span>
                                <input @keypress="onlyNumberCep($event)" id="cep" name="cep" v-model="cep" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text cursor-pointer" id="inputGroup-sizing" @click="buscarCep()">Buscar</span>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Endereço:</span>
                                <input id="endereco" name="endereco" v-model="endereco" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                                <input id="cidade" name="cidade" v-model="cidade" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                                <input id="bairro" name="bairro" v-model="bairro" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                                <input id="uf" name="uf" v-model="uf" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR CONCORRENTE-->
        <!--MODAL VISUALIZAR CONCORRENTE-->
        <div class="modal fade w3-animate-top" id="visualizarConcorrente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarCaixaModalLabel" aria-hidden="true">
        <form id="formvisualizarConcorrente" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Visualizar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarAlteracao(idConcorrente)" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconAlterar" /></button></div>
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
                        <input id="action" name="action" v-model='actionAlterar' type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="idConcorrente" name="idConcorrente" v-model='idConcorrente' type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Nome:</span>
                                <input disabled id="razaoSocial" name="razaoSocial" v-model='razaoSocial' type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bandeira:</span>
                                <select disabled required id='bandeira' name='bandeira' v-model='bandeira' class='form-select' aria-label='Default select example'>
                                    <option selected>BANDEIRA</option>
                                    <option>RDP</option>
                                    <option>BRANCA</option>
                                    <option>PETROBRAS</option>
                                    <option>IPIRANGA</option>
                                    <option>SHELL</option>
                                    <option>POTENCIAL</option>
                                    <option>ALE</option>
                                    <option>LATINA</option>
                                    <option>ESSO</option>
                                    <option>TEXACO</option>
                                    <option>OUTRA</option>
                                </select>
                                <span class="input-group-text" id="inputGroup-sizing">Distancia:</span>
                                <input disabled id="distancia" name="distancia" v-model="distancia" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cep:</span>
                                <input disabled id="cep" name="cep" v-model="cep" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Endereço:</span>
                                <input disabled id="endereco" name="endereco" v-model="endereco" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                                <input disabled id="cidade" name="cidade" v-model="cidade" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                                <input disabled id="bairro" name="bairro" v-model="bairro" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                                <input disabled id="uf" name="uf" v-model="uf" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Gasolina C:</span>
                                <input id="gasolinaC" name="gasolinaC" v-model="gasolinaC" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">Gasolina Adit:</span>
                                <input id="gasolinaAd" name="gasolinaAd" v-model="gasolinaAd" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Diesel C:</span>
                                <input id="dieselC" name="dieselC" v-model="dieselC" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">Diesel Ad:</span>
                                <input id="dieselAd" name="dieselAd" v-model="dieselAd" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Etanol:</span>
                                <input id="etanol" name="etanol" v-model="etanol" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">GNV:</span>
                                <input id="gnv" name="gnv" v-model="gnv" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL VISUALIZAR CONCORRENTE-->
</div>
<!--FIM DIV APP VUE JS-->