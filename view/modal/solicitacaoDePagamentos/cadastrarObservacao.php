    <!--MODAL INCLUIR OBSERVAÇÃO-->
    <div class="modal fade w3-animate-top" id="incluirObservacaoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <form id="incluirObservacaoForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Observação</h2>
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                            <button type="button" @click="voltarVisualizar(id)" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="text" v-model="actionObs" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="text" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="observacao" id="observacao" v-model="observacao" cols="80" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" v-show="observacao.length > 10" @click="salvarObservacao()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR OBSERVAÇÃO-->