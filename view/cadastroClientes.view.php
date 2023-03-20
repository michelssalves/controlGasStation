<?php
include('model/CadastroClientes.php');
include('controller/cadastroClientes.php');
?>
<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE EST� A TABELA E FILTROS-->
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
                        <button type="button" class='btn btn-light btn-sm' @click="modalSolPgtos()"><img class="iconeSize" :src="iconCreate"></button>
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
                            <th>ULT A플O</th>
                            <th>DT ULT A플O</th>
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
    <!--/AREA ONDE EST� A TABELA E FILTROS-->
</div>
<!--FIM DIV APP VUE JS-->