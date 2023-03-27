<?php
include('model/CadastroClientes.php');
include('controller/cadastroClientes.php');
?>
<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroPagamentos'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <input @keyup="getClientes('filtrar')" @mouseleave="getClientes('filtrar')" class='form-control' type='date' id='data1' name="data1">
                    </div>
                    <div class="col-md-2 p-1">
                        <input @keyup="getClientes('filtrar')" @mouseleave="getClientes('filtrar')" class='form-control' type='date' id='data2' name="data2">
                    </div>
                    <div class="col-md-2 p-1">
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-4">
                                <li><input :checked="check" @click="getClientes('filtrar')" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getClientes('filtrar')" type="checkbox" id="statusCadastrado" name="statusCadastrado" value="CADASTRADO" /> CADASTRADO</label></li>
                                <li><input @click="getClientes('filtrar')" type="checkbox" id="statusSerasa" name="statusSerasa" value="CONFERIDO SERASA" /> SERASA</label></li>
                                <li><input @click="getClientes('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="abrirModal('criarCliente')"><img class="iconeSize" :src="iconCreate"></button>
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
                            <th>IDX</th>
                            <th>FILIAL</th>
                            <th>RZ SOCIAL</th>
                            <th>CIDADE</th>
                            <th>STATUS</th>
                            <th>CADASTRO</th>
                            <th>ULT AÇÃO</th>
                            <th>DT ULT AÇÃO</th>
                            <th>DIAS PARADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cliente, i) in clientes" @click="visualizar(cliente.Id,'dadosCadastrais')" style="cursor:pointer">
                            <td>{{cliente.Id}}</td>
                            <td>{{cliente.idXpert}}</td>
                            <td>{{cliente.loginName}}</td>
                            <td>{{cliente.RazaoSocial}}</td>
                            <td>{{cliente.cidade}}</td>
                            <td>{{cliente.status}}</td>
                            <td>{{cliente.data_cadastro}}</td>
                            <td>{{cliente.usuario}}</td>
                            <td>{{cliente.dataHora}}</td>
                            <td>{{cliente.dias}}</td>
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
    <!--MODAL CRIAR SOLICITAÇÃO DE PAGAMENTO-->
    <div class="modal fade w3-animate-top" id="criarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarClienteModalLabel" aria-hidden="true">
        <form id="formcriarCliente" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Cliente</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvar('formcriarCliente')" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconSave" /></button></div>
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
                            <span class="input-group-text" id="inputGroup-sizing">Rz Social:</span>
                            <input id="cliente" name="cliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CNPJ:</span>
                            <input id="cnpj" name="cnpj" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Pessoa:</span>
                            <select id="pessoa" name="pessoa" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">TIPO</option>
                                <option value="1">JURIDICA</option>
                                <option value="2">FISICA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input id="cep" name="cep" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Endereco:</span>
                            <input id="endereco" name="endereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input id="cidade" name="cidade" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input id="bairro" name="bairro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Contato:</span>
                            <input id="contato" name="contato" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                            <input id="uf" name="uf" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Nº:</span>
                            <input id="numEndereco" name="numEndereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Complemento:</span>
                            <input id="complemento" name="complemento" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">ID Xpert:</span>
                            <input id="idXpert" name="idXpert" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">IE:</span>
                            <input id="ie" name="ie" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Apelido:</span>
                            <input id="nomeUsual" name="nomeUsual" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Email:</span>
                            <input id="email" name="email" type="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Fone:</span>
                            <input id="fone" name="fone" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Pgto:</span>
                            <select id="prazoPgto" name="prazoPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">TIPO</option>
                                <option value="1">JURIDICA</option>
                                <option value="2">FISICA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Abast:</span>
                            <select id="prazoAbast" name="prazoAbast" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>7</option>
                                <option>10</option>
                                <option>15</option>
                                <option>30</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Pgto:</span>
                            <select id="tipoPgto" name="tipoPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option class="versalete10">SELECIONE</option>
                                <option class="versalete10">A VISTA</option>
                                <option class="versalete10">A PRAZO</option>
                                <option class="versalete10">A VISTA - SÓ DANFE</option>
                            </select>
                        </div>
                        <hr>
                        <div class="grid text-center">
                            <input type="checkbox" class="w3-check" name="forma_pgto2" value="1"> Cheque Pré
                            <input type="checkbox" class="w3-check" name="forma_pgto3" value="1"> Convênio/C.Crédito
                            <input type="checkbox" class="w3-check" name="forma_pgto4" value="1"> Cartão de Débito
                            <input type="checkbox" class="w3-check" name="forma_pgto5" value="1"> Carta Frete
                            <input type="checkbox" class="w3-check" name="forma_pgto6" value="1"> Boleto Bancário
                            <input type="checkbox" class="w3-check" name="forma_pgto7" value="1"> Cheque à Vista
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR SOLICITAÇÃO DE PAGAMENTO-->
    <!--MODAL DADOS CADASTRAIS-->
    <div class="modal fade w3-animate-top" id="dadosCadastrais" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosCadastraisModalLabel" aria-hidden="true">
        <form id="formDadosCadastrais" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Cadastro</h2>
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
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Rz Social:</span>
                            <input id="cliente" name="cliente" type="text" v-model="cadastro.RazaoSocial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CNPJ:</span>
                            <input id="cnpj" name="cnpj" type="text" v-model="cadastro.CNPJ" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Pessoa:</span>
                            <select id="pessoa" name="pessoa" class='form-select' v-model="cadastro.pessoa" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">TIPO</option>
                                <option value="1">JURIDICA</option>
                                <option value="2">FISICA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input id="cep" name="cep" type="text" v-model="cadastro.cep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Endereco:</span>
                            <input id="endereco" name="endereco" type="text" v-model="cadastro.endereco" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input id="cidade" name="cidade" type="text" v-model="cadastro.cidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input id="bairro" name="bairro" type="text" v-model="cadastro.bairro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Contato:</span>
                            <input id="Contato" name="Contato" type="text" v-model="cadastro.Contato" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                            <input id="uf" name="uf" type="text" v-model="cadastro.uf" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Nº:</span>
                            <input id="numEndereco" name="numEndereco" type="text" v-model="cadastro.numEndereco" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Complemento:</span>
                            <input id="complEndereco" name="complEndereco" v-model="cadastro.complEndereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">ID Xpert:</span>
                            <input id="idXpert" name="idXpert" type="text" v-model="cadastro.idXpert" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">IE:</span>
                            <input id="ie" name="ie" type="text" v-model="cadastro.ie" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Apelido:</span>
                            <input id="nomeUsual" name="nomeUsual" type="text" v-model="cadastro.nomeUsual" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Email:</span>
                            <input id="email" name="email" type="email" v-model="cadastro.email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Fone:</span>
                            <input id="fone" name="fone" type="text" v-model="cadastro.fone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL DADOS CADASTRAIS-->
    <!--MODAL DADOS FINANCEIRO-->
    <div class="modal fade w3-animate-top" id="dadosFinanceiros" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosFinanceirosModalLabel" aria-hidden="true">
        <form id="formDadosFinanceiros" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Financeiro</h2>
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
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Melhor dia para pagamento:</span>
                            <input id="cliente" name="cliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Consulta Serasa:</span>
                            <input id="cnpj" name="cnpj" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Limite:</span>
                            <input id="cep" name="cep" type="text" v-model="financeiro.limite" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Carência:</span>
                            <input id="endereco" name="endereco" type="text" v-model="financeiro.carencia" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Alcool (%):</span>
                            <input id="cidade" name="cidade" type="text" v-model="financeiro.desc_alcool" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Alcool (%):</span>
                            <input id="complemento" name="complemento" v-model="financeiro.acr_alcool" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Gasolina (%):</span>
                            <input id="bairro" name="bairro" type="text" v-model="financeiro.desc_gasolina" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Gasolina (%):</span>
                            <input id="idXpert" name="idXpert" type="text" v-model="financeiro.acr_gasolina" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Diesel S500 (%):</span>
                            <input id="uf" name="uf" type="text" v-model="financeiro.desc_dieselS500" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Diesel S500 (%):</span>
                            <input id="nomeUsual" name="nomeUsual" type="text" v-model="financeiro.acr_dieselS500" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Diesel S10 (%):</span>
                            <input id="contato" name="contato" type="text" v-model="financeiro.desc_dieselS10" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Diesel S10 (%):</span>
                            <input id="ie" name="ie" type="text" v-model="financeiro.acr_dieselS10" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto GNV (%):</span>
                            <input id="numero" name="numero" type="text" v-model="financeiro.desc_gnv" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo GNV (%):</span>
                            <input id="email" name="email" type="email" v-model="financeiro.acr_gnv" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Pgto:</span>
                            <select id="prazoPgto" name="prazoPgto" v-model="financeiro.prazoPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="financeiro.prazoPgto">{{financeiro.prazoPgto}}</option>
                                <option v-for="dia in 31" :key="dia" :value="dia">{{dia}}</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Abast:</span>
                            <select id="prazoAbast" name="prazoAbast" v-model="financeiro.prazoAbast"class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>7</option>
                                <option>10</option>
                                <option>15</option>
                                <option>30</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Pgto:</span>
                            <select id="tipoPgto" name="tipoPgto" v-model="financeiro.formaPgtoPadrao" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option class="versalete10">SELECIONE</option>
                                <option class="versalete10">A VISTA</option>
                                <option class="versalete10">A PRAZO</option>
                                <option class="versalete10">A VISTA - SÓ DANFE</option>
                            </select>
                        </div>
                        <hr>
                        <div class="grid text-center">
                            <input type="checkbox" class="w3-check" name="forma_pgto2" value="1"> Cheque Pré
                            <input type="checkbox" class="w3-check" name="forma_pgto3" value="1"> Convênio/C.Crédito
                            <input type="checkbox" class="w3-check" name="forma_pgto4" value="1"> Cartão de Débito
                            <input type="checkbox" class="w3-check" name="forma_pgto5" value="1"> Carta Frete
                            <input type="checkbox" class="w3-check" name="forma_pgto6" value="1"> Boleto Bancário
                            <input type="checkbox" class="w3-check" name="forma_pgto7" value="1"> Cheque à Vista
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL DADOS FINANCEIRO-->
    <!--MODAL VEICULOS-->
    <div class="modal fade w3-animate-top" id="dadosVeiculos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosDocumentosModalLabel" aria-hidden="true">
        <form id="formDadosVeiculos" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Veiculos</h2>
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
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>ID</th>
                                            <th>MARCA</th>
                                            <th>MODELO</th>
                                            <th>ANO</th>
                                            <th>COR</th>
                                            <th>PLACA</th>
                                            <th>KM</th>
                                            <th>COMBUSTIVEL</th>
                                            <th>DESCONTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="(veiculo, i) in veiculos">
                                            <td>{{veiculo.id}}</td>
                                            <td>{{veiculo.marca}}</td>
                                            <td>{{veiculo.modelo}}</td>
                                            <td>{{veiculo.ano}}</td>
                                            <td>{{veiculo.cor}}</td>
                                            <td>{{veiculo.placa}}</td>
                                            <td>{{veiculo.km}}</td>
                                            <td>{{veiculo.combustivel}}</td>
                                            <td>{{veiculo.desconto}}</td>
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
    <!--/MODAL VEICULOS-->
    <!--MODAL DADOS ANEXOS-->
    <div class="modal fade w3-animate-top" id="dadosDocumentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosDocumentosModalLabel" aria-hidden="true">
        <form id="formDadosDocumentos" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Documentos</h2>
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
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>ANEXO</th>
                                            <th>DATA</th>
                                            <th>USUARIO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="anexo in anexos">
                                            <td>{{anexo.descricao}}</td>
                                            <td>{{anexo.datahora}}</td>
                                            <td>{{anexo.usuario}}</td>
                               
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
    <!--/MODAL ANEXOS-->
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
    <!--MODAL EVENTOS-->
    <div class="modal fade w3-animate-top" id="dadosEventos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosEventosModalLabel" aria-hidden="true">
        <form id="formDadosEventos" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Eventos</h2>
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
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>EVENTO</th>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="evento in eventos">
                                            <td>{{evento.obs}}</td>
                                            <td>{{evento.datahora}}</td>
                                            <td>{{evento.usuario}}</td>

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
    <!--MODAL EVENTOS-->
</div>
<!--FIM DIV APP VUE JS-->