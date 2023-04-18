    <!--MODAL CRIAR PEDIDO-->
    <div class="modal fade w3-animate-top" id="criarSolicitacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSolicitacaoModalLabel" aria-hidden="true">
        <form id="formCriarSolicitacao" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-6">Criar Solicitação</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button v-show="items.length > 0" type="button" @click="salvarSolicitacao()" title="Salvar" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" @click="addItem()" title="Adc" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconCarrinhoCompras" /></button></div>
                            <div class="p-1"><button type="button" @click="fecharModal()" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Classe:</span>
                            <select @change="getProdutos()" v-model="idClasse" id="classes" name="classes" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option v-for="classe in classes" :key="classe.id" :value="classe.id">{{classe.descricao}}</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
                            <select v-model="selectedOption" @change="getOptionText" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option v-for="produto in produtos" :key="produto.id" :value="produto.id">{{produto.descricao}}</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Qtde</span>
                            <input id="quantidade" name="quantidade" type="text" v-model="qtde" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                    </div>
                    <div class="container">
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover mt-1 ">
                                <thead class="header-tabela">
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in items" :key="item.id">
                                        <td>{{ item.produto }}</td>
                                        <td>{{ item.qtde }}</td>
                                        <td @click="excluirItem(item)"><img :src="iconCancelar" /></td>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR PEDIDO-->