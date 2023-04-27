<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formChequesDevolvidos'>
            <div class="container">
                <div class="row">
                    <div class="col-md-1 p-1">
                        <div class="dropdown">
                            <button class="form-select " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-3">
                                <li><input checked="true" @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusNegociando" name="statusNegociando" value="NEGOCIANDO" /> NEGOCIANDO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusQuitado" name="statusQuitado" value="QUITADO" /> QUITADO</label></li>
                                <li><input checked="true" @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusPfin" name="statusPfin" value="PFIN" /> PFIN</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusJuridico" name="statusJuridico" value="JURIDICO" /> JURIDICO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusExecucao" name="statusExecucao" value="EXECUÇÃO" /> EXECUÇÃO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusCaducou" name="statusCaducou" value="CADUCOU" /> CADUCOU</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusExtraviado" name="statusExtraviado" value="EXTRAVIADO" /> EXTRAVIADO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getChequeDevolvidos('filtrar')" id='tipoData' name='tipoData' class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option selected value='0'>Data Inclusão</option>
                            <option value='1'>Data Cheque</option>
                            <option value='2'>Data Devolução</option>
                            <option value='3'>Data Quitação</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getChequeDevolvidos('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <input class='form-control' type='date' name='data1' id='data1' v-model="data1">
                    </div>
                    <div class="col-md-2 p-1">
                        <input class='form-control' type='date' name='data2' id='data2' v-model="data2">
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm'><img class="iconeSize" :src="iconCreate"></button>
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
                            <th>Dt Reg</th>
                            <th>Cliente</th>
                            <th>Nr Cheque</th>
                            <th>Dt Cheque</th>
                            <th>Valor</th>
                            <th>Dt Devol</th>
                            <th>Dias</th>
                            <th>$ Corr</th>
                            <th>Dt Quit</th>
                            <th>Med</th>
                            <th>Stat</th>
                            <th>UltAlt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(cheque.id)" v-for="(cheque, index) in chequesDevolvidos">
                            <td>{{cheque.dthrInclusao}}</td>
                            <td :title="cheque.nomeCliente">{{cheque.nome}}</td>
                            <td>{{cheque.nrcheque}}</td>
                            <td>{{cheque.dtCheque}}</td>
                            <td>{{cheque.valor | duasCasasDecimais}}</td>
                            <td>{{cheque.dataDevolucao}}</td>
                            <td>{{cheque.dias}}</td>
                            <td>{{cheque.valorCorr | duasCasasDecimais}}</td>
                            <td>{{cheque.dtQuitacao}}</td>
                            <td>{{cheque.loginName}}</td>
                            <td>{{cheque.status}}</td>
                            <td>{{cheque.ultimaAlteracao}}</td>
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
        </form>
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
    <?php
    include 'modal/chequesDevolvidos/visualizarCheque.php';
    include 'modal/chequesDevolvidos/incluirAnexo.php';
    include 'modal/chequesDevolvidos/incluirObservacao.php';
    include 'modal/chequesDevolvidos/alterarStatus.php';
    include 'modal/chequesDevolvidos/alterarStatusQuitar.php';
    ?>
