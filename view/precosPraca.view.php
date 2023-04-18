<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroConcorrentes'>
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="modalCadastrarConcorrente()"><img class="iconeSize" :src="iconCreate"></button>
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
                            <th>NOME</th>
                            <th>BANDEIRA</th>
                            <th>DIST</th>
                            <th>GASOL C</th>
                            <th>GASOL C ADIT</th>
                            <th>ETANOL</th>
                            <th>DIESEL C</th>
                            <th>DIESEL S10</th>
                            <th>GNV</th>
                            <th>DATA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(concorrente.cid)" style="cursor:pointer" v-for="concorrente in concorrentes">
                            <td>{{ concorrente.cid }}</td>
                            <td>{{ concorrente.nome }}</td>
                            <td>{{ concorrente.bandeira }}</td>
                            <td>{{ concorrente.distancia }}</td>
                            <td>{{ concorrente.preco_GasC | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_GasCAdit | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_etanol | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_Diesel | quatroCasasDecimais }}</td>
                            <td>{{ concorrente.preco_DieselAdit | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.preco_GNV | quatroCasasDecimais}}</td>
                            <td>{{ concorrente.dataAtu }}</td>
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
    include 'modal/precosPraca/criarPrecoConcorrente.php';
    include 'modal/precosPraca/visualizarPrecoConcorrente.php';
    ?>
</div>
<!--FIM DIV APP VUE JS-->