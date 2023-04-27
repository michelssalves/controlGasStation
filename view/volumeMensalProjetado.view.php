<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroVolumeMensalProjetado'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select name="gerencia" id="gerencia" @change="getVolumeMensalProjetado('formFiltroVolumeMensalProjetado')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">GERENCIADEREDE</option>
                            <option value="4">GERENCIAREDE04</option>
                            <option value="6">GERENCIAREDE06</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="periodo" id="periodo" @change="getVolumeMensalProjetado('formFiltroVolumeMensalProjetado')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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
                        <tr style="cursor:pointer">
                        
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
    <?php
    ?>
</div>
<!--FIM DIV APP VUE JS-->