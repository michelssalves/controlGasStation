    <!--MODAL CRIAR ANEXO OK-->
    <div class="modal fade w3-animate-top" id="criarAnexo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarAnexoModalLabel" aria-hidden="true">
        <form id="formCriarAnexo" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvar('formCriarAnexo','action=addAnexo','dadosDocumentos', idCliente)" v-show="(files.length > 0 && descricaoAnexo.length > 0)" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarModal(idCliente, 'dadosObservacao')" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="id" name="id" type="text" v-model="idCliente" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
                                <select v-model="descricaoAnexo" id="descricaoAnexo" name="descricaoAnexo" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                    <option>DOCUMENTOS PESSOAIS (RG, CPF)</option>
                                    <option>COMPROVANTE DE RENDA (HOLERITE/IRPF/IRPJ)</option>
                                    <option>CARTÃO CNPJ</option>
                                    <option>CONTRATO SOCIAL</option>
                                    <option>COMPROVANTE DE ENDEREÇO</option>
                                    <option>AUTORIZAÇÃO PARA ABASTECIMENTO</option>
                                    <option>OUTRO</option>
                                </select>
                            </div>
                            <div class="container">
                                <div v-if="files.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input name="file" type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
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
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR ANEXO-->
