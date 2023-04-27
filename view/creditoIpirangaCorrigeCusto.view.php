<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroCreditoIpirangaCorrigeCusto'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select name="produto" id="produto" @change="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">PRODUTO</option>
                            <option value="1">GASOLINA C COMUM</option>
                            <option value="2">GASOLINA C ADITIVADA</option>
                            <option value="3">ETANOL</option>
                            <option value="4">OLEO DIESEL B S500</option>
                            <option value="5">OLEO DIESEL B S10</option>
                            <option value="6">GNV</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="cidade" id="cidade" @change="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">CIDADE</option>
                            <option v-for="cidade in cidades" :value="cidade.IdEntidade">{{cidade.CidadeEntidade}}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="destino" id="destino" @change="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">DESTINO</option>
							<option>PR</option>
							<option>SC</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <input class='form-control' type='date' id='data1' name="data1">
                    </div>
                    <div class="col-md-2 p-1">
                        <input class='form-control' type='date' id='data2' name="data2">
                    </div>
                    <div class="col-md-2 ">
                        <button type="button" class='btn btn-light btn-sm' @click="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')"><img class="iconeSize" :src="iconSearch"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="abrirModal('dadosFrete')"><img class="iconeSize" :src="iconTruck"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="abrirModal('criarFrete')"><img class="iconeSize" :src="iconCreate"></button>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table table-sm table-hover w3-striped mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>DATA</th>
                            <th>PRODUTO</th>
                            <th>ORIGEM</th>
                            <th>DESTINO</th>
                            <th>$ UNITÁRIO</th>
                            <th>$ FRETE</th>
                            <th>$ CUSTO TT</th>
                            <th>USUARIO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(credito,i) in filtroCredito" style="cursor:pointer">
                            <td>{{credito.dataMovimento}}</td>
                            <td>{{credito.produto}}</td>
                            <td>{{credito.origem}}</td>
                            <td>{{credito.destino}}</td>
                            <td>{{credito.custo}}</td>
                            <td>{{credito.frete}}</td>
                            <td>{{credito.custoTT}}</td>
                            <td>{{credito.usuario}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
    <?php
    include 'modal/creditoIpirangaCorrigeCusto/visualizarFrete.php';
    include 'modal/creditoIpirangaCorrigeCusto/cadastrarFrete.php';
    ?>