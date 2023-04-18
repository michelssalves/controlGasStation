    <!--MODAL CRIAR FECHAMENTO-->
    <div class="modal fade w3-animate-top" id="criarCaixa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarCaixaModalLabel" aria-hidden="true">
        <form id="formCriarCaixa" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Criar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarFechamento()" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <input id="action" name="action" type="hidden" v-model="actionCriar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro:</span>
                            <input id="dinheiro" name="dinheiro" type="text" v-model="criarDinheiro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                            <input id="cheque" name="cheque" type="text" v-model="criarCheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Brinks:</span>
                            <input id="brinks" name="brinks" type="text" v-model="criarBrinks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Pix:</span>
                            <input id="pix" name="pix" type="text" v-model="criarPix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Data</span>
                            <input name="dataCaixa" id="dataCaixa" v-model="criarData" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Turno Definitivo:</span>
                            <select required v-model="criarTurnoDefinitivo" name='turnos_definitivo' id='turnos_definitivo' class='form-select' aria-label='Default select example'>
                                <option value="">Escolha</option>
                                <option>SIM</option>
                                <option>N�O</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <textarea name="criarObs" id="criarObs" v-model="criarObs" cols="80" rows="2" style="white-space: pre;" placeholder="Observa��o" maxlength="500" required></textarea>
                        </div>
                        <div class="container">
                            <div v-if="files.length == 0" class="large-12 medium-12 small-12 filezone">
                                <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
                                <p>
                                    Arraste aqui <br>ou clique para procurar
                                </p>
                            </div>

                            <div v-for="(file, key) in files" class="file-listing">
                                <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                {{ file.name }}
                                <div class="success-container" v-if="file.id > 0">

                                </div>
                                <div class="remove-container" v-else>
                                    <a class="remove" v-on:click="removeFile(key)"><i class="fa-regular fa-trash-can"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR FECHAMENTO-->