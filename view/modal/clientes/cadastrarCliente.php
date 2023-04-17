    <!--MODAL CRIAR CLIENTE-->
    <div class="modal fade w3-animate-top" id="criarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarClienteModalLabel" aria-hidden="true">
        <form id="formCriarCliente" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Cliente</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvar('formCriarCliente', 'action=addCliente')" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconSave" /></button></div>
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
                            <span class="input-group-text" id="inputGroup-sizing">Rz Social:</span>
                            <input id="cliente" name="cliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CNPJ:</span>
                            <input id="cnpj" name="cnpj" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Pessoa:</span>
                            <select id="pessoa" name="pessoa" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">TIPO</option>
                                <option value="1">JURIDICA</option>
                                <option value="2">FISICA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input id="cep" name="cep" v-model="cep" type="text" @keypress="onlyNumberCep($event)" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="S� numeros" required>
                            <span class="input-group-text" id="inputGroup-sizing" @click="buscarCep()"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Endereco:</span>
                            <input id="endereco" name="endereco" v-model="endereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input id="cidade" name="cidade" v-model="cidade" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input id="bairro" name="bairro" v-model="bairro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Contato:</span>
                            <input id="contato" name="contato" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                            <input id="uf" name="uf" v-model="uf" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Nº:</span>
                            <input id="numEndereco" name="numEndereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Complemento:</span>
                            <input id="complemento" name="complemento" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">ID Xpert:</span>
                            <input id="idXpert" name="idXpert" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">IE:</span>
                            <input id="ie" name="ie" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Apelido:</span>
                            <input id="nomeUsual" name="nomeUsual" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Email:</span>
                            <input id="email" name="email" type="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Fone:</span>
                            <input id="fone" name="fone" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Pgto:</span>
                            <select id="prazoPgto" name="prazoPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">TIPO</option>
                                <option value="1">JURIDICA</option>
                                <option value="2">FISICA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Prazo Abast:</span>
                            <select id="prazoAbast" name="prazoAbast" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>7</option>
                                <option>10</option>
                                <option>15</option>
                                <option>30</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Pgto:</span>
                            <select id="tipoPgto" name="tipoPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option class="versalete10">SELECIONE</option>
                                <option class="versalete10">A VISTA</option>
                                <option class="versalete10">A PRAZO</option>
                                <option class="versalete10">A VISTA - S� DANFE</option>
                            </select>
                        </div>
                        <hr>
                        <div class="grid text-center">
                            <input type="checkbox" class="w3-check" name="forma_pgto0" value="1"> Dinheiro
                            <input type="checkbox" class="w3-check" name="forma_pgto1" value="1"> A Prazo
                            <input type="checkbox" class="w3-check" name="forma_pgto2" value="1"> Cheque Pr�
                            <input type="checkbox" class="w3-check" name="forma_pgto3" value="1"> Conv�nio/C.Cr�dito
                            <input type="checkbox" class="w3-check" name="forma_pgto4" value="1"> D�bito
                            <input type="checkbox" class="w3-check" name="forma_pgto5" value="1"> Carta Frete
                            <input type="checkbox" class="w3-check" name="forma_pgto6" value="1"> Boleto
                            <input type="checkbox" class="w3-check" name="forma_pgto7" value="1"> Cheque � Vista
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR CLIENTE-->