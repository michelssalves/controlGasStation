<!--MODAL INCLUIR ANEXO OK-->
<div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>ANEXO</h1>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="idChequeAnexo" name="idChequeAnexo" required>
                    <input type="hidden" value="gravarAnexo" name="actionAnexo" id="actionAnexo" required>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
                        <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Titulo para o arquivo" required>
                    </div>
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing">Comprovante:</span>
                        <input id="arquivoAnexo" type="file" name="arquivoAnexo" class="form-control" required />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="salvarAnexo()">Anexar</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="fecharModal(this.form.idChequeAnexo.value)">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL INCLUIR ANEXO-->