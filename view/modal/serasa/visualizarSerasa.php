    <!--MODAL VISUALIZAR SERASA-->
    <div class="modal fade w3-animate-top" id="visualizarSerasa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerSerasa" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status == 'CANCELADO' || status == 'BAIXADO'" class="p-1"><button type="button" title="PFIN" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                            <div class="d-flex flex-row" v-if="status != 'BAIXADO'">
                                <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="Pfin" class="btn btn-light btn-sm" :disabled="disabled" data-bs-dismiss="modal" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                                <div v-if="status == 'PEFIN'" class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" :disabled="disabled" data-bs-dismiss="modal" @click="modalBaixado(id_requisicao)"><img class="iconeSize" :src="iconQuitar"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" :title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm" @click="aplicarIcon ? salvarAlteracoes(id_requisicao) : '' "><img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title" :src="aplicarIcon ? iconEdit : iconSave" /></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button></div>
                            </div>
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
                            <input id="id_requisicao" name="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CPF/CNPJ:</span>
                            <input disabled id="cnpj" name="cnpj" type="text" v-model="cnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
                            <input disabled id="cliente" name="cliente" type="text" v-model="cliente" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input disabled id="cidade" name="cidade" type="text" v-model="cidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input disabled id="bairro" name="bairro" type="text" v-model="bairro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input disabled id="cep" name="cep" type="text" v-model="cep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Rua:</span>
                            <input disabled id="rua" name="rua" type="text" v-model="rua" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Nº:</span>
                            <input disabled id="numero" name="numero" type="text" v-model="numero" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dt Nascimento:</span>
                            <input :readonly="readonly" id="dtNascimento" name="dtNascimento" type="date" v-model="dtNascimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Emissão:</span>
                            <input :readonly="readonly" id="dtEmissao" name="dtEmissao" type="date" v-model="dtEmissao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Vencimento:</span>
                            <input :readonly="readonly" id="dtVencimento" name="dtVencimento" type="date" v-model="dtVencimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Documento:</span>
                            <select id="tipo" name="tipo" v-model="tipo" class='form-select' aria-label='Default select example'>
                                <option :value="tipo">{{tipo}}</option>
                                <option value='CHEQUE'>CHEQUE</option>
                                <option value='NOTA'>NOTA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Valor(Inicial):</span>
                            <input :readonly="readonly" id="valorInicial" name="valorInicial" @keypress="onlyNumber" type="number" v-model="valorInicial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor(Juros):</span>
                            <input :readonly="readonly" id="valorJuros" name="valorJuros" @keypress="onlyNumber" type="number" v-model="valorJuros" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                            <textarea disabled id="observacao" name="observacao" cols="60" rows="7" type="text" v-model="observacao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                        </div>
                        <div class="container">
                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-striped table-hover mt-2">
                                        <thead class="header-tabela">
                                            <tr>
                                                <th>DATA</th>
                                                <th>USUARIO</th>
                                                <th>OBS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="obs in observacoeSerasa">
                                                <td>{{obs.datahora}}</td>
                                                <td>{{obs.usuario}}</td>
                                                <td>{{obs.obs}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-striped table-hover mt-2">
                                        <thead class="header-tabela">
                                            <tr>
                                                <th>DESCRIÇÃO</th>
                                                <th>DOCUMENTO</th>
                                                <th>EXT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr @click="newTab(anexo.id)" style="cursor:pointer" v-for="anexo in anexoSerasa">
                                                <td>{{anexo.descricao}}</td>
                                                <td>{{anexo.numDoc}}</td>
                                                <td>{{anexo.extensao}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>EVENTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="evento in eventoSerasa">
                                            <td>{{evento.datahora}}</td>
                                            <td>{{evento.evento}}</td>
                                            <td>{{evento.usuario}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL VISUALIZAR SERASA-->