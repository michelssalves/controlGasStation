    <!--MODAL EVENTOS-->
    <div class="modal fade w3-animate-top" id="dadosFrete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dadosFreteModalLabel" aria-hidden="true">
        <form id="formDadosFrete" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">Fretes</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1">
                                <button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover mt-2">
                                <thead class="header-tabela">
                                    <tr>
                                        <th>PRODUTO</th>
                                        <th>UF</th>
                                        <th>CIDADE</th>
                                        <th>FRETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor:pointer">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--MODAL EVENTOS-->