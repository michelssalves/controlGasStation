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
                                <li><input :checked="check" @click="getClientes('filtrar')" type="checkbox" id="statusCadastrado" name="statusCadastrado" value="CADASTRADO" /> CADASTRADO</label></li>
                                <li><input :checked="check" @click="getClientes('filtrar')" type="checkbox" id="statusSerasa" name="statusSerasa" value="CONFERIDO SERASA" /> SERASA</label></li>
                                <li><input :checked="check" @click="getClientes('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
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
                        <tr @click="" style="cursor:pointer" v-for="(cliente, i) in clientes">
                            <td>{{cliente.Id}} {{ x }}</td>
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
                        <div class="grid text-center">
                            <input type="checkbox" class="w3-check" name="forma_pgto2" value="1"> Cheque Pré
                            <input type="checkbox" class="w3-check" name="forma_pgto3" value="1"> Convênio/C.Crédito
                            <input type="checkbox" class="w3-check" name="forma_pgto4" value="1"> Cartão de Débito
                            <input type="checkbox" class="w3-check" name="forma_pgto5" value="1"> Carta Frete
                            <input type="checkbox" class="w3-check" name="forma_pgto6" value="1"> Boleto Bancário
                            <input type="checkbox" class="w3-check" name="forma_pgto7" value="1"> Cheque à Vista
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!--/MODAL CRIAR SOLICITAÇÃO DE PAGAMENTO-->
</div>
<!--FIM DIV APP VUE JS-->