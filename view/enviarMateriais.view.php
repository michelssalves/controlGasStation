<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA COM FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroSolicitacoes'>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 p-1">
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-3">
                                <li><input @click="getSolicitacoes('filtrar')" class="ml-3" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getSolicitacoes('filtrar')" class="ml-3" type="checkbox" id="statusEnviado" name="statusEnviado" value="ENVIADO" /> ENVIADO</label></li>
                                <li><input @click="getSolicitacoes('filtrar')" class="ml-3" type="checkbox" id="statusFinalizado" name="statusFinalizado" value="FINALIZADO" /> FINALIZADO</label></li>
                                <li><input @click="getSolicitacoes('filtrar')" class="ml-3" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <select @change="getSolicitacoes('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 p-1">
                        <input @keyup="getSolicitacoes('filtrar')" type="text" class='form-control' id="produto" name="produto" placeholder="Produto">
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="modalCriarSolicitacao()"><img class="iconeSize" :src="iconCreate"></button>
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
        </form>
    </div>
    <!--/AREA ONDE ESTÁ A TABELA COM FILTROS-->
    <?php
    include 'modal/enviarMateriais/visualizarItemRequsicao.php';
    include 'modal/enviarMateriais/visualizarRequisicao.php';
    include 'modal/enviarMateriais/criarRequisicao.php';
    include 'modal/enviarMateriais/cancelarRequisicao.php';
    include 'modal/enviarMateriais/criarObservacao.php';
    ?>
</div>
<!--/FIM DIV APP VUE JS-->