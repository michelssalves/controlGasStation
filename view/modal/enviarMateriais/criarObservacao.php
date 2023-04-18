    <!--MODAL INCLUIR OBSERVA��O-->
    <div class="modal fade w3-animate-top" id="incluirObservacaoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <form id="incluirObservacaoForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 mt-1 bg-dark rounded-circle text-light fs-4">Observa��o</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarObservacao(idPedido)" v-show="observacao.length > 10" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="modalVisualizarSolicitacao(idPedido)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input name="idPedido" id="idPedido" type="hidden" v-model="idPedido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVA��O SOBRE ESTA SOLICITA��O</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="observacao" id="observacao" v-model="observacao" cols="80" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR OBSERVA��O-->