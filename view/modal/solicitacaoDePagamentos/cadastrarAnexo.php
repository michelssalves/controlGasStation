    <!--MODAL INCLUIR ANEXO -->
    <div class="modal fade w3-animate-top" id="incluirAnexoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <form id="formAnexar" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                            <button type="button" @click="voltarVisualizar(id)" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="hidden" v-model="anexoAdicional" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="container">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
                                    <input id="descricao" name="descricao" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                <div v-if="filesAnexar.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="filesAnexar" ref="filesAnexar" multiple v-on:change="handleFilesAnxAdicional()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(file, key) in filesAnexar" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ file.name }}
                                    <div class="success-container" v-if="file.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFileAnxAdicional(key)"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal" type="button" class="btn btn-success btn-sm" v-on:click="salvarAnxAdicional('gravarAnexo')" v-show="filesAnexar.length > 0">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR ANEXO-->