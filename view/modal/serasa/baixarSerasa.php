    <!--/MODAL BAIXAR SERASA-->
    <div class="modal fade w3-animate-top" id="baixarSerasaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="baixarSerasaModalLabel" aria-hidden="true">
        <form id="formBaixarSerasa" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarBaixa()" v-show="filesBaixar.length > 0" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="visualizarSerasa(id_requisicao)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="id_requisicao" name="id" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="status" name="status" type="hidden" value="BAIXADO" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="evento" name="evento" type="hidden" value="PENDENCIA BAIXADO" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="observacaoStatus" name="observacaoStatus" type="hidden" value="ALTERADO PARA BAIXADA" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="descricao" name="descricao" type="hidden" value="COMPROVANTE DE PAGAMENTO" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="container">
                                <div v-if="filesBaixar.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="filesBaixar" ref="filesBaixar" multiple v-on:change="handleFilesB()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(fileB, key) in filesBaixar" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ fileB.name }}
                                    <div class="success-container" v-if="fileB.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFileB(key)"><i class="fa-regular fa-trash-can"></i></a>
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
    <!-- /MODAL BAIXAR SERASA-->