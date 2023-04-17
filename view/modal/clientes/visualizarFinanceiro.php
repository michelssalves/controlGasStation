    <!--MODAL DADOS FINANCEIRO-->
    <div class="modal fade w3-animate-top" id="dadosFinanceiros" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosFinanceirosModalLabel" aria-hidden="true">
        <form id="formDadosFinanceiros" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Financeiro</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1">
                                <button type="button" title="Salvar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="salvar('formDadosFinanceiros', 'action=updateClienteFinanceiro', 'dadosFinanceiros', idCliente)"><img class="iconeSize" :src="iconSave"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Cadastrais" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosCadastrais')"><img class="iconeSize" :src="iconCadastro"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Financeiro" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosFinanceiros')"><img class="iconeSize" :src="iconFinanceiro"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Veiculos" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosVeiculos')"><img class="iconeSize" :src="iconTruck"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Dados Documentos" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosDocumentos')"><img class="iconeSize" :src="iconAnx"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Observacões" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosObservacao')"><img class="iconeSize" :src="iconObs"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Eventos" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="visualizar(idCliente, 'dadosEventos')"><img class="iconeSize" :src="iconEventos"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="fundo-header-tabelas d-flex justify-content-center">
                                <div v-show="message.length > 0" class="text-dark fs-6 ">
                                    <h4>{{message}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="id" id="id" v-model="idCliente">
                            <span class="input-group-text" id="inputGroup-sizing">Melhor dia para pagamento:</span>
                            <input id="dia" name="dia" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Consulta Serasa:</span>
                            <input id="serasa" name="serasa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Limite:</span>
                            <input id="limite" name="limite" type="text" v-model="financeiro.limite" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Carência:</span>
                            <input id="carencia" name="carencia" type="text" v-model="financeiro.carencia" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Alcool (%):</span>
                            <input id="desc_alcool" name="desc_alcool" type="text" v-model="financeiro.desc_alcool" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Alcool (%):</span>
                            <input id="acr_alcool" name="acr_alcool" v-model="financeiro.acr_alcool" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Gasolina (%):</span>
                            <input id="desc_gasolina" name="desc_gasolina" type="text" v-model="financeiro.desc_gasolina" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Gasolina (%):</span>
                            <input id="acr_gasolina" name="acr_gasolina" type="text" v-model="financeiro.acr_gasolina" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Diesel S500 (%):</span>
                            <input id="desc_dieselS500" name="desc_dieselS500" type="text" v-model="financeiro.desc_dieselS500" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Diesel S500 (%):</span>
                            <input id="acr_dieselS500" name="acr_dieselS500" type="text" v-model="financeiro.acr_dieselS500" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto Diesel S10 (%):</span>
                            <input id="desc_dieselS10" name="desc_dieselS10" type="text" v-model="financeiro.desc_dieselS10" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo Diesel S10 (%):</span>
                            <input id="acr_dieselS10" name="acr_dieselS10" type="text" v-model="financeiro.acr_dieselS10" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Desconto GNV (%):</span>
                            <input id="desc_gnv" name="desc_gnv" type="text" v-model="financeiro.desc_gnv" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Acréscimo GNV (%):</span>
                            <input id="acr_gnv" name="acr_gnv" type="email" v-model="financeiro.acr_gnv" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Pgto:</span>
                            <select id="prazoPgto" name="prazoPgto" v-model="financeiro.prazoPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="financeiro.prazoPgto">{{financeiro.prazoPgto}}</option>
                                <option v-for="dia in 31" :key="dia" :value="dia">{{dia}}</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Abast:</span>
                            <select id="prazoAbast" name="prazoAbast" v-model="financeiro.prazoAbast" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>7</option>
                                <option>10</option>
                                <option>15</option>
                                <option>30</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Pgto:</span>
                            <select id="formaPgtoPadrao" name="formaPgtoPadrao" v-model="financeiro.formaPgtoPadrao" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option class="versalete10">SELECIONE</option>
                                <option class="versalete10">A VISTA</option>
                                <option class="versalete10">A PRAZO</option>
                                <option class="versalete10">A VISTA - SÓ DANFE</option>
                            </select>
                        </div>
                        <hr>
                        <div class="grid text-center">
                            <input type="checkbox" :checked="fpg1" class="w3-check" name="forma_pgto0" value="1"> Dinheiro
                            <input type="checkbox" :checked="fpg2" class="w3-check" name="forma_pgto1" value="1"> A Prazo
                            <input type="checkbox" :checked="fpg3" class="w3-check" name="forma_pgto2" value="1"> Cheque Pré
                            <input type="checkbox" :checked="fpg4" class="w3-check" name="forma_pgto3" value="1"> Convênio/C.Crédito
                            <input type="checkbox" :checked="fpg5" class="w3-check" name="forma_pgto4" value="1"> Débito
                            <input type="checkbox" :checked="fpg6" class="w3-check" name="forma_pgto5" value="1"> Carta Frete
                            <input type="checkbox" :checked="fpg7" class="w3-check" name="forma_pgto6" value="1"> Boleto
                            <input type="checkbox" :checked="fpg8" class="w3-check" name="forma_pgto7" value="1"> Cheque à Vista
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL DADOS FINANCEIRO-->