    <!--MODAL ALTERAR STATUS-->
    <div class="modal fade w3-animate-top" id="alteraStatusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="alteraStatusModalLabel" aria-hidden="true">
        <form id="formAlterarStatusCheque" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Status</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarCancelamento()" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id)" class="btn btn-sm" id="botaoFechar" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">

                        <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="action" name="action" type="hidden" v-model="actionStatus" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="input-group input-group-sm mb-3">
                            <div class="container">
                                <p>Selecione o novo status para o Cheque</p>
                                <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
                                <select v-model="status" id="status" name="status" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                    <option :value='status'>{{status}}</option>
                                    <option value='NOVO'>NOVO</option>
                                    <option value='NEGOCIANDO'>NEGOCIANDO</option>
                                    <option value='PFIN'>PFIN</option>
                                    <option value='JURIDICO'>JURIDICO</option>
                                    <option value='EXECUÇÃO'>EXECUÇÃO</option>
                                    <option value='CADUCOU'>CADUCOU</option>
                                    <option value='EXTRAVIADO'>EXTRAVIADO</option>
                                    <option value='CANCELADO'>CANCELADO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL ALTERAR STATUS-->