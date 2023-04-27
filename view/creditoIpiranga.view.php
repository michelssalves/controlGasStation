<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroCreditoIpiranga'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select @change="getCreditoIpiranga('formFiltroCreditoIpiranga')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="">Filial</option>
                            <option v-for="med in meds" :key="med.idXpert" :value="med.idXpert">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-4">
                                <li><input @click="getCreditoIpiranga('formFiltroCreditoIpiranga')" type="checkbox" id="P1" name="P1" value="1" /> GASOLINA C COMUM</label></li>
                                <li><input @click="getCreditoIpiranga('formFiltroCreditoIpiranga')" type="checkbox" id="P2" name="P2" value="2" /> GASOLINA C ADITIVADA</label></li>
                                <li><input @click="getCreditoIpiranga('formFiltroCreditoIpiranga')" type="checkbox" id="P3" name="P3" value="3" /> ETANOL</label></li>
                                <li><input @click="getCreditoIpiranga('formFiltroCreditoIpiranga')" type="checkbox" id="P4" name="P4" value="4" /> OLEO DIESEL B S500</label></li>
                                <li><input @click="getCreditoIpiranga('formFiltroCreditoIpiranga')" type="checkbox" id="P5" name="P5" value="5" /> OLEO DIESEL B S10</label></li>
                                <li><input @click="getCreditoIpiranga('formFiltroCreditoIpiranga')" type="checkbox" id="P6" name="P6" value="6" /> GNV</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="bandeira" id="bandeira" @change="getCreditoIpiranga('formFiltroCreditoIpiranga')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="">BANDEIRA</option>
							<option>RDP</option>
							<option>IPIRANGA</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="periodo" id="periodo" @change="getCreditoIpiranga('formFiltroCreditoIpiranga')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option :value="`${ano}-${mes}-1`">Periodo</option>
                            <option v-for="periodo in periodos" :key="periodo.id" :value="`${periodo.ano}-${periodo.mes}-1`">{{ periodo.nomeMes }}-{{ periodo.ano }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class='btn btn-light btn-sm'><a href="?p=14"><img class="iconeSize" :src="iconCredito"></a></button>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table table-sm table-hover w3-striped mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>MED</th>
                            <th>DATA</th>
                            <th>FILIAL</th>
                            <th>FORNECEDOR</th>
                            <th>ORIGEM</th>
                            <th>NR NF</th>
                            <th>PRODUTO</th>
                            <th>QTDE</th>
                            <th>$UNIT(NF)</th>
                            <th>$TOTAL(NF)</th>
                            <th>$UNIT(NEG)</th>
                            <th>$TOTAL(NEG)</th>
                            <th>$CRÉDITO(NEG)</th>
                            <th>$VENDA</th>
                            <th>%RENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(credito,i) in creditoIpirangaFiltrado" style="cursor:pointer">
                            <td>{{credito.Posto}}</td>
                            <td>{{credito.DataComprovante}}</td>
                            <td>{{credito.Cidade}}</td>
                            <td>{{credito.Bandeira}}</td>
                            <td>{{credito.CidadeEntidade}} - {{credito.UfEntidade}} </td>
                            <td>{{credito.NrComprovante}}</td>
                            <td>{{credito.NomeProduto}}</td>
                            <td>{{credito.Qtde}}</td>
                            <td>{{credito.ValorUnitario}}</td>
                            <td>{{credito.ValorTotal}}</td>
                            <td>{{credito.ValUnitNeg}}</td>
                            <td>{{credito.ValTotNeg}}</td>
                            <td>{{credito.Diferenca}}</td>
                            <td>{{credito.PrecoVenda}}</td>
                            <td>{{credito.Rentabilidade}}</td>
                        </tr>
                        <tr>
                            <td colspan="7"></td>
                            <td>{{somarQuantidade}}</td>
                            <td></td>
                            <td>{{somarTotalNf}}</td>
                            <td colspan="4"></td>
                            <td>{{somarRentabilidade}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
