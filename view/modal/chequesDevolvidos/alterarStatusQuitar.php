    <!--MODAL QUITAR-->
    <div class="modal fade w3-animate-top" id="modalQuitarCheque" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="quitarChequeModalLabel" aria-hidden="true">
        <form id="formQuitar" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarAnexoQuitar()" class="btn btn-light btn-sm" v-show="filesQuitar.length > 0" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id)" class="btn btn-sm" id="botaoFechar" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="text" v-model="actionQuitar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="text" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="container">
                                <p><strong>Anexar comprovante para confirmar quitação</strong></p>
                                <div v-if="filesQuitar.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="filesQuitar" ref="filesQuitar" multiple v-on:change="handleFilesQuitar()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(fileQ, key) in filesQuitar" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ fileQ.name }}
                                    <div class="success-container" v-if="fileQ.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFileQuitar(key)"><i class="fa-regular fa-trash-can"></i></a>
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
    <!--/MODAL QUITAR-->