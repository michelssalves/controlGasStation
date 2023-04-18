    <!--MODAL VISUALIZAR CONCORRENTE-->
    <div class="modal fade w3-animate-top" id="visualizarConcorrente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarCaixaModalLabel" aria-hidden="true">
        <form id="formvisualizarConcorrente" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Visualizar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarAlteracao(idConcorrente)" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconAlterar" /></button></div>
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
                            <input id="action" name="action" v-model='actionAlterar' type="hidden" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <input id="idConcorrente" name="idConcorrente" v-model='idConcorrente' type="hidden" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Nome:</span>
                                <input disabled id="razaoSocial" name="razaoSocial" v-model='razaoSocial' type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bandeira:</span>
                                <select disabled required id='bandeira' name='bandeira' v-model='bandeira' class='form-select' aria-label='Default select example'>
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
                                <input disabled id="distancia" name="distancia" v-model="distancia" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cep:</span>
                                <input disabled id="cep" name="cep" v-model="cep" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Endereço:</span>
                                <input disabled id="endereco" name="endereco" v-model="endereco" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                                <input disabled id="cidade" name="cidade" v-model="cidade" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                                <input disabled id="bairro" name="bairro" v-model="bairro" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                                <input disabled id="uf" name="uf" v-model="uf" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Gasolina C:</span>
                                <input id="gasolinaC" name="gasolinaC" v-model="gasolinaC" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">Gasolina Adit:</span>
                                <input id="gasolinaAd" name="gasolinaAd" v-model="gasolinaAd" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Diesel C:</span>
                                <input id="dieselC" name="dieselC" v-model="dieselC" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">Diesel Ad:</span>
                                <input id="dieselAd" name="dieselAd" v-model="dieselAd" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Etanol:</span>
                                <input id="etanol" name="etanol" v-model="etanol" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <span class="input-group-text" id="inputGroup-sizing">GNV:</span>
                                <input id="gnv" name="gnv" v-model="gnv" type="text" class="form-control input-uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL VISUALIZAR CONCORRENTE-->