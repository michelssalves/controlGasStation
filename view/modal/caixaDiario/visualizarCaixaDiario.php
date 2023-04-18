<!--MODAL VISUALIZAR CX DIÁRIO-->
    <div class="modal fade w3-animate-top" id="visualizarCaixaDiario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarCaixaDiarioModalLabel" aria-hidden="true">
        <form id="formCaixaDiario" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status == 'ABERTO'" class="p-1">
                                <button type="button" title="Fechar Caixa" :disabled="disabled" class="btn btn-light btn-sm" :data-bs-dismiss="readonly ? modal : ''" @click="modalFecharCaixa(id_requisicao, 'Fechar')"><img class="iconeSize" :src="iconCxFechado"></button>
                            </div>
                            <div v-if="status == 'NOVO'" class="p-1">
                                <button type="button" title="Abrir Caixa" :disabled="disabled" class="btn btn-light btn-sm" :data-bs-dismiss="readonly ? modal : ''" @click="modalAbrirCaixa(id_requisicao, 'Abrir')"><img class="iconeSize" :src="iconCx"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" :title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm" @click="aplicarIcon ? salvarAlteracoes(id_requisicao, 'alterarCaixa') : '' ">
                                    <img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title" :src="aplicarIcon ? iconEdit : iconSave" /></button>
                            </div>
                            <div v-if="!(status == 'FECHADO' || status == 'CANCELADO')" class="p-1">
                                <button type="button" title="Observação" :disabled="disabled" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Anexo" :disabled="disabled" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button>
                            </div>
                            <div v-if="!(status == 'FECHADO' || status == 'CANCELADO')" class="p-1">
                                <button type="button" title="Cancelar Caixa" :disabled="disabled" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal">
                                    <img class="iconeSize" :src="iconClose"></button>
                            </div>
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
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro:</span>
                            <input :readonly="readonly" id="dinheiro" name="dinheiro" type="text" v-model="dep_dinheiro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                            <input :readonly="readonly" id="cheque" name="cheque" type="text" v-model="dep_cheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Brinks:</span>
                            <input :readonly="readonly" id="brinks" name="brinks" type="text" v-model="dep_brinks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Pix:</span>
                            <input :readonly="readonly" id="pix" name="pix" type="text" v-model="pix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class=" input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">MED:</span>
                            <select :disabled="disabled" v-model="idMed" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="idMed" selected>{{ loginName }}</option>
                                <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Data</span>
                            <input :readonly="readonly" id="dataCaixa" name="dataCaixa" type="date" v-model="data_caixa " class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Definitivo:</span>
                            <input :readonly="readonly" id="definitivo" name="definitivo" type="text" v-model="turnos_definitivo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Conciliação:</span>
                            <select :disabled="disabled" v-model="conc" id="conc" name="conc" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="conc">{{conc}}</option>
                                <option>SIM</option>
                                <option>NÃO</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Fechamento:</span>
                            <select :disabled="disabled" v-model="caixa" id="caixa" name="caixa" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="caixa">{{caixa}}</option>
                                <option>SIM</option>
                                <option>NÃO</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                            <textarea disabled id="observacao" name="observacao" cols="60" rows="7" type="text" v-model="obs" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                        </div>
                        <div class="container">
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>STATUS</th>
                                            <th>TIPO</th>
                                            <th>DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="newTab(anexoCaixa.id, anexoCaixa.extensao)" style="cursor:pointer" v-for="(anexoCaixa, i) in anexosCaixa">
                                            <td>{{anexoCaixa.descricao}}</td>
                                            <td>{{anexoCaixa.extensao}}</td>
                                            <td>{{anexoCaixa.dthr_anexo}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>USUARIO</th>
                                            <th>OBS</th>
                                            <th>DATA</th>
                                            <th>GERADO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="(eventoCaixa, i) in eventosCaixa">
                                            <td>{{eventoCaixa.usuario}}</td>
                                            <td>{{eventoCaixa.obs}}</td>
                                            <td>{{eventoCaixa.datahora}}</td>
                                            <td>{{eventoCaixa.gerado}}</td>
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
<!--/MODAL VISUALIZAR CX DIÁRIO-->