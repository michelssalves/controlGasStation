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
    <?php
    include 'modal/clientes/cadastrarCliente.php';
    include 'modal/clientes/cadastrarVeiculo.php';
    include 'modal/clientes/cadastrarAnexo.php';
    include 'modal/clientes/cadastrarObservacao.php';
    include 'modal/clientes/visualizarCadastro.php';
    include 'modal/clientes/visualizarFinanceiro.php';
    include 'modal/clientes/visualizarVeiculos.php';
    include 'modal/clientes/visualizarAnexos.php';
    include 'modal/clientes/visualizarObservacao.php';
    include 'modal/clientes/visualizarEventos.php';
    ?>
