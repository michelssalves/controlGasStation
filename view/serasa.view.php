<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA COM FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroSerasa'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-3">
                                <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusPefin" name="statusPefin" value="PEFIN" /> PEFIN</label></li>
                                <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusBaixado" name="statusBaixado" value="BAIXADO" /> BAIXADO</label></li>
                                <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getPendencias('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getPendencias('filtrar')" id="matrizFiltro" name="matriz" class="form-select" aria-label="Default select example">
                            <option value='2'>Todos</option>
                            <option value='1'>Matriz</option>
                            <option value='0'>Meds</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getPendencias('filtrar')" id="tipoFiltro" name="tipo" class='form-select' aria-label='Default select example'>
                            <option value='0'>Tipo</option>
                            <option value='CHEQUE'>CHEQUE</option>
                            <option value='NOTA'>NOTA</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <input @keyup="getPendencias('filtrar')" type="text" class='form-control' id="nomeClienteFiltro" name="nomeCliente" placeholder="Nome do Cliente">
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="modalCriarDeposito()"><img class="iconeSize" :src="iconCreate"></button>
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
                <table class="table table-striped table-hover mt-1">
                    <thead class="header-tabela">
                        <tr>
                            <th>IDR</th>
                            <th>ID</th>
                            <th>MED</th>
                            <th>Tipo do Documento</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Dt de Emissão</th>
                            <th>Dt de Vencimento</th>
                            <th>Matriz ?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="visualizarSerasa(pfin.id_requisicao)" v-for="(pfin, i) in pendencias" style="cursor:pointer">
                            <td>{{pfin.id_requisicao}}</td>
                            <td>{{pfin.id}}</td>
                            <td>{{pfin.loginName}}</td>
                            <td>{{pfin.tipo}}</td>
                            <td>{{pfin.nomeCliente | upper}}</td>
                            <td>{{pfin.valor | duasCasasDecimais}}</td>
                            <td>{{pfin.dataEmissao | dataFormatada}}</td>
                            <td>{{pfin.dataVencimento | dataFormatada}}</td>
                            <td>{{pfin.ematriz}}</td>
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
    <!--/AREA ONDE ESTÁ A TABELA COM FILTROS -->
    <?php
    include 'modal/serasa/visualizarSerasa.php';
    include 'modal/serasa/criarAnexo.php';
    include 'modal/serasa/criarObservacao.php';
    include 'modal/serasa/baixarSerasa.php';
    include 'modal/serasa/cancelarSerasa.php';
    ?>
</div>
<!--FIM DIV APP VUE JS-->