<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroCaixaDiario'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <input @keyup="getCaixas('filtrar')" class='form-control' type='date' id='data1' name="data1" v-model="filtroData1">
                    </div>
                    <div class="col-md-2 p-1">
                        <input @keyup="getCaixas('filtrar')" class='form-control' type='date' id='data2' name="data2" v-model="filtroData2">
                    </div>
                    <div class="col-md-1 p-1">
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-3">
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusAberto" name="statusAberto" value="ABERTO" /> ABERTO</label></li>
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusFechado" name="statusFechado" value="FECHADO" /> FECHADO</label></li>
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getCaixas('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getCaixas('filtrar')" id='turnoDefinitivo' name='turnoDefinitivo' class='form-select' aria-label='Default select example'>
                            <option value='0'>Turno</option>
                            <option value='SIM'>Sim</option>
                            <option value='NAO'>Não</option>
                        </select>
                    </div>
                    <div class="col-md-1 p-1">
                        <select @change="getCaixas('filtrar')" id='concBancaria' name='concBancaria' class='form-select' aria-label='Default select example'>
                            <option value='0'>Conci</option>
                            <option value='SIM'>Sim</option>
                            <option value='NAO'>Não</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="modalCriarCaixa()"><img class="iconeSize" :src="iconCreate"></button>
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
                <table class="table table-striped table-hover">
                    <thead class="header-tabela">
                        <tr>
                            <th>ID</th>
                            <th>STATUS</th>
                            <th>MED</th>
                            <th>DATA</th>
                            <th>DINHEIRO</th>
                            <th>CHEQUE</th>
                            <th>BRINKS</th>
                            <th>PIX</th>
                            <th>TOTAL</th>
                            <th title="TURNOS EM DEFINITIVO">TURNO</th>
                            <th>OBS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(caixa.id_requisicao)" style="cursor:pointer" v-for="(caixa, i, x) in caixas">
                            <td>{{caixa.id_requisicao}}</td>
                            <td>{{caixa.status}}</td>
                            <td>{{caixa.loginName}}</td>
                            <td>{{caixa.data_caixa | dataFormatada }}</td>
                            <td>{{caixa.dep_dinheiro | duasCasasDecimais}}</td>
                            <td>{{caixa.dep_cheque | duasCasasDecimais}}</td>
                            <td>{{caixa.dep_brinks | duasCasasDecimais}}</td>
                            <td>{{caixa.pix | duasCasasDecimais}}</td>
                            <td>{{caixa.soma}}</td>
                            <td>{{caixa.turnos_definitivo}}</td>
                            <td>{{caixa.obs}}</td>
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
    include 'modal/caixaDiario/visualizarCaixaDiario.php';
    include 'modal/caixaDiario/incluirAnexo.php';
    include 'modal/caixaDiario/incluirObservacao.php';
    include 'modal/caixaDiario/criarFechamento.php';
    include 'modal/caixaDiario/cancelarFechamento.php';
    ?>
