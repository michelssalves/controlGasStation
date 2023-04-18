    <!--MODAL VISUALIZAR ITEM-->
    <div class="modal fade w3-animate-top" id="modalvisualizarItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarItemModalLabel" aria-hidden="true">
        <form id="formVisualizarItem" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-4">Alterar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarQtdes(idPedido)" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Cancelar" @click="cancelarItem(idPedido)" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconExc"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="modalVisualizarSolicitacao(idPedido)" class="btn btn-sm" data-bs-dismiss="modal" id="botaoFechar"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input name="idPedido" id="idPedido" type="hidden" v-model="idPedido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input name="idItem" id="idItem" type="hidden" v-model="idItem" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Produto:</span>
                            <input disabled type="text" v-model="produto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Quantidade:</span>
                            <input id="quantidade" name="quantidade" type="text" v-model="quantidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL VISUALIZAR ITEM-->