    <!--MODAL DADOS CADASTRAIS-->
    <div class="modal fade w3-animate-top" id="dadosCadastrais" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosCadastraisModalLabel" aria-hidden="true">
        <form id="formDadosCadastrais" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Cadastro</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1">
                                <button type="button" title="Salvar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="salvar('formDadosCadastrais', 'action=updateClienteCadastrais', 'dadosCadastrais',idCliente)"><img class="iconeSize" :src="iconSave"></button>
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
                            <span class="input-group-text" id="inputGroup-sizing">Rz Social:</span>
                            <input id="cliente" name="cliente" type="text" v-model="cadastro.RazaoSocial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CNPJ:</span>
                            <input id="cnpj" name="cnpj" type="text" v-model="cadastro.CNPJ" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Pessoa:</span>
                            <select id="pessoa" name="pessoa" class='form-select' v-model="cadastro.pessoa" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option value="0">TIPO</option>
                                <option value="1">JURIDICA</option>
                                <option value="2">FISICA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input id="cep" name="cep" type="text" v-model="cadastro.cep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Endereco:</span>
                            <input id="endereco" name="endereco" type="text" v-model="cadastro.endereco" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input id="cidade" name="cidade" type="text" v-model="cadastro.cidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input id="bairro" name="bairro" type="text" v-model="cadastro.bairro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Contato:</span>
                            <input id="Contato" name="Contato" type="text" v-model="cadastro.Contato" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                            <input id="uf" name="uf" type="text" v-model="cadastro.uf" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Nº:</span>
                            <input id="numEndereco" name="numEndereco" type="text" v-model="cadastro.numEndereco" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Complemento:</span>
                            <input id="complEndereco" name="complEndereco" v-model="cadastro.complEndereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">ID Xpert:</span>
                            <input id="idXpert" name="idXpert" type="text" v-model="cadastro.idXpert" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">IE:</span>
                            <input id="ie" name="ie" type="text" v-model="cadastro.ie" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Apelido:</span>
                            <input id="nomeUsual" name="nomeUsual" type="text" v-model="cadastro.nomeUsual" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Email:</span>
                            <input id="email" name="email" type="email" v-model="cadastro.email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Fone:</span>
                            <input id="fone" name="fone" type="text" v-model="cadastro.fone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL DADOS CADASTRAIS-->