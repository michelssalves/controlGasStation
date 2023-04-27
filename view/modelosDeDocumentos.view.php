<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="table-wrapper">
        <table class="table table-striped table-hover mt-1 ">
            <thead class="header-tabela">
                <tr>
                    <th>MODELO DE DOCUMENTO</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(doc, index) in documentos">
                    <td><a class="a-link-color" :href="doc.link">{{doc.name}}</a></td>
                </tr>
            </tbody>
        </table>
    </div>
<!--AREA ONDE ESTÁ A TABELA E FILTROS-->