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
                        <select name="ano" id="ano" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option>ANO</option>
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                            <option>2020</option>
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table table-sm table-hover w3-striped mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>COD</th>

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
