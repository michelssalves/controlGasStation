    <!--MODAL CRIAR CLIENTE-->
    <div class="modal fade w3-animate-top" id="criarFrete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarFreteModalLabel" aria-hidden="true">
        <form id="formCriarFrete" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Criar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvar('formCriarFrete', 'action=addFrete')" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <!--<div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>-->
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
                            <select name="produto" id="produto" @change="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">PRODUTO</option>
                                <option value="1">GASOLINA C COMUM</option>
                                <option value="2">GASOLINA C ADITIVADA</option>
                                <option value="3">ETANOL</option>
                                <option value="4">OLEO DIESEL B S500</option>
                                <option value="5">OLEO DIESEL B S10</option>
                                <option value="6">GNV</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
                            <select name="cidade" id="cidade" @change="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">CIDADE</option>
                                <option v-for="cidade in cidades" :value="cidade.IdEntidade">{{cidade.CidadeEntidade}}</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
                            <select name="destino" id="destino" @change="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">DESTINO</option>
                                <option>PR</option>
                                <option>SC</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Custo:</span>
                            <input id="valor" name="valor" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Data:</span>
                            <input id="data" name="data" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR CLIENTE-->