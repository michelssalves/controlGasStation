<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroPagamentos'>
            <div class="container">
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
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
    <?php
    include 'modal/solicitacaoDePagamentos/visualizarPagamento.php';
    include 'modal/solicitacaoDePagamentos/cadastrarAnexo.php';
    include 'modal/solicitacaoDePagamentos/cadastrarObservacao.php';
    include 'modal/solicitacaoDePagamentos/cadastrarSolicitaoDePagamento.php';
    ?>
</div>
<!--FIM DIV APP VUE JS-->