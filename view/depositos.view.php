<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA COM FILTROS LINHA -->
    <div class="tableArea">
        <form method='POST' id='formularioDepositos'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select @change="getDepositos('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getDepositos('filtrar')" required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                            <option value="CONTA">CONTA</option>
                            <option>BB</option>
                            <option>BB MEDS</option>
                            <option>BB PROPRIO</option>
                            <option>ITAU</option>
                            <option>BRINKS</option>
                            <option>PROSEGUR</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <input @keyup="getDepositos('filtrar')" @mouseleave="getDepositos('filtrar')" type='date' class='form-control' name='data1' id='data1'>
                    </div>
                    <div class="col-md-2 p-1">
                        <input @keyup="getDepositos('filtrar')" @mouseleave="getDepositos('filtrar')" type='date' class='form-control' name='data2' id='data2'>
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
                <table class="table table-striped table-hover mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>DT MOV</th>
                            <th>DIA SEM</th>
                            <th>MED</th>
                            <th>DINHEIRO</th>
                            <th>CONTA DIN</th>
                            <th>CHEQUE</th>
                            <th>CONTA CH</th>
                            <th>TOTAL DEP</th>
                            <th>DÉBITO</th>
                            <th>DT REG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(deposito.id)" v-for="deposito in depositos">
                            <td>{{deposito.dataMovimento}}</td>
                            <td>{{deposito.diaDaSemana | diaSemana}}</td>
                            <td>{{deposito.loginName}}</td>
                            <td>{{deposito.dinheiro | duasCasasDecimais}}</td>
                            <td>{{deposito.conta}}</td>
                            <td>{{deposito.cheque | duasCasasDecimais}}</td>
                            <td>{{deposito.contaCh | duasCasasDecimais}}</td>
                            <td>{{deposito.ttdep | duasCasasDecimais}}</td>
                            <td>{{deposito.debito | duasCasasDecimais}}</td>
                            <td>{{deposito.dataRegistro}}</td>
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
    <!--/AREA ONDE ESTÁ A TABELA COM FILTROS LINHA -->
    <?php
    include 'modal/depositos/visualizarDeposito.php';
    include 'modal/depositos/criarObservacao.php';
    include 'modal/depositos/criarDeposito.php';
    ?>
</div>
<!--/FIM DIV APP VUE JS-->