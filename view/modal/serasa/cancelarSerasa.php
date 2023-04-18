    <!--MODAL CANCELAR-->
    <div class="modal fade w3-animate-top" id="modalCancelarSerasa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelarSerasaModalLabel" aria-hidden="true">
        <form id="formCancelamento" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Cancelamento</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" v-show="observacaoStatus.length > 10" @click="salvarCancelamento()" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="visualizarSerasa(id_requisicao)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="id_requisicao" name="id" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="status" name="status" type="hidden" value="CANCELADO" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="evento" name="evento" type="hidden" value="PENDENCIA CANCELADA" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI O MOTIVO DO CANCELAMENTO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="observacaoStatus" id="observacaoStatus" v-model="observacaoStatus" cols="80" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CANCELAR-->