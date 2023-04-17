<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroMetas'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select name="gerencia" id="gerencia" @change="getMetas('formFiltroMetas')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">GERENCIADEREDE</option>
                            <option value="4">GERENCIAREDE04</option>
                            <option value="6">GERENCIAREDE06</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="idGrupo" id="idGrupo" @change="getMetas('formFiltroMetas')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">GRUPO</option>
                            <option value="1">COMBUSTÍVEIS</option>
                            <option value="2">AUTOMOTIVO</option>
                            <option value="5">CONVENINÊNCIA</option>
                            <option value="6">CICLO OTTO</option>
                            <option value="7">DIESEL</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="periodo" id="periodo" @change="getMetas('formFiltroMetas')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option :value="`${ano}-${mes}-1`">Periodo</option>
                            <option v-for="periodo in periodos" :key="periodo.id" :value="`${periodo.ano}-${periodo.mes}-1`">{{ periodo.nomeMes }}-{{ periodo.ano }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table table-sm table-hover w3-striped mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>COD</th>
                            <th>FILIAL</th>
                            <th>VENDAS</th>
                            <th>CIGARRO</th>
                            <th title="Soma">SOMA</th>
                            <th title="Projeção">PROJEÇÃO</th>
                            <th>META</th>
                            <th>% META</th>
                            <th>COMISSÃO%</th>
                            <th>META</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(meta, i) in pessoasFiltradas" style="cursor:pointer">
                            <td>{{ meta.id_filial }}</td>
                            <td>{{ meta.loginname }}</td>
                            <td>{{ meta.vendas | duasCasasDecimais}}</td>
                            <td>{{ meta.cigarro | duasCasasDecimais }}</td>
                            <td>{{ meta.totalVendido | duasCasasDecimais }}</td>
                            <td>{{ meta.projecao | duasCasasDecimais }}</td>
                            <td>{{ meta.meta_mes | duasCasasDecimais}}</td>
                            <td v-bind:class="{'meta-verde': meta.percentualMetaMes >= 100, 'meta-vermelho': meta.percentualMetaMes < 100}">{{ meta.percentualMetaMes | duasCasasDecimais }}%</td>
                            <td v-bind:class="{'meta-verde': meta.percentualMetaMes >= 100, 'meta-vermelho': meta.percentualMetaMes < 100}">{{ meta.comissao | duasCasasDecimais}} </td>
                            <td>{{ meta.meta_anual | duasCasasDecimais }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php 
    ?>
</div>
<!--FIM DIV APP VUE JS-->