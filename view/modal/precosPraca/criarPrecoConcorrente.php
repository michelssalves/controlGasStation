    <!--MODAL CRIAR CONCORRENTE-->
    <div class="modal fade w3-animate-top" id="cadastrarConcorrente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarCaixaModalLabel" aria-hidden="true">
        <form id="formCadastrarConcorrente" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Cadastrar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarConcorrente()" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="fecharModal(id)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <input id="action" name="action" v-model='actionCadastrar' type="hidden" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Nome:</span>
                                <input id="razaoSocial" name="razaoSocial" v-model='razaoSocial' type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bandeira:</span>
                                <select required id='bandeira' name='bandeira' v-model='bandeira' class='form-select' aria-label='Default select example'>
                                    <option selected>BANDEIRA</option>
                                    <option>RDP</option>
                                    <option>BRANCA</option>
                                    <option>PETROBRAS</option>
                                    <option>IPIRANGA</option>
                                    <option>SHELL</option>
                                    <option>POTENCIAL</option>
                                    <option>ALE</option>
                                    <option>LATINA</option>
                                    <option>ESSO</option>
                                    <option>TEXACO</option>
                                    <option>OUTRA</option>
                                </select>
                                <span class="input-group-text" id="inputGroup-sizing">Distancia:</span>
                                <input @keypress="onlyNumber($event)" id="distancia" name="distancia" v-model="distancia" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cep:</span>
                                <input @keypress="onlyNumberCep($event)" id="cep" name="cep" v-model="cep" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text cursor-pointer" id="inputGroup-sizing" @click="buscarCep()">Buscar</span>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Endereço:</span>
                                <input id="endereco" name="endereco" v-model="endereco" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                                <input id="cidade" name="cidade" v-model="cidade" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                                <input id="bairro" name="bairro" v-model="bairro" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                                <input id="uf" name="uf" v-model="uf" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR CONCORRENTE-->