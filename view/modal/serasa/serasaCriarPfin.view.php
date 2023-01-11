<!--MODAL CRIAR PFIN-->
<div class="modal fade" id="criaNovoPfin" tabindex="-1" aria-labelledby="serasaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>CRIAR PFIN</h1>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="input-group input-group-sm mb-3">
                        <input type="hidden" name="p" value="5" required>
                        <span class="input-group-text" id="inputGroup-sizing">Tipo:</span>
                        <select id="tipoDoc" name="tipoDoc" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                            <option selected disabled value=''> TIPO</option>
                            <option>CHEQUE</option>
                            <option>NOTA</option>
                        </select>
                        <span class="input-group-text" id="inputGroup-sizing">Filial:</span>
                        <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
                         <option selected disabled value=''> MED</option>
                            <?= $cboMed ?>
                        </select>
                        <span class="input-group-text" id="inputGroup-sizing">Valor:</span>
                        <input name="valor" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
             
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Dt Emissão:</span>
                        <input name="dataEmissao" type="date" class="form-control form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <span class="input-group-text" id="inputGroup-sizing">Dt Vencimento:</span>
                        <input name="dataVencimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <span class="input-group-text" id="inputGroup-sizing">Dt Nascimento:</span>
                        <input name="dataNascimento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">CNPJ/CPF:</span>
                        <input onkeypress="return soNumeros();" name="cnpj" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nome do Cliente:</span>
                        <input name="nomeCliente" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                        <input onkeypress="return soNumeros();" onkeyup="buscaCep(this.value)" name="cep" id="cep" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Rua:</span>
                        <input name="endereco" id="endereco" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
              
                        <span class="input-group-text" id="inputGroup-sizing">Numero:</span>
                        <input name="numero" type="text" class="form-control col-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">UF:</span>
                        <input name="estado" id="uf" type="text" class="form-control col-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                        <input name="cidade" id="cidade" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                        <input name="bairro" id="bairro" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                        <textarea name="obs" type="text" cols="10" rows="2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nº Doc:</span>
                        <input name="numDoc1" id="numDoc" type="text" class="form-control col-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <input name="arquivo1" type="file" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nº Doc:</span>
                        <input name="numDoc2" id="numDoc" type="text" class="form-control col-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <input name="arquivo2" type="file" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nº Doc:</span>
                        <input name="numDoc3" id="numDoc" type="text" class="form-control col-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <input name="arquivo3" type="file" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nº Doc:</span>
                        <input name="numDoc4" id="numDoc" type="text" class="form-control col-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <input name="arquivo4" type="file" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nº Doc:</span>
                        <input name="numDoc5" id="numDoc" type="text" class="form-control col-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                        <input name="arquivo5" type="file" class="form-control">
                    </div>

            </div>
            <div class="modal-footer">
                <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
                    <button type="submit" class="btn btn-outline-success btn-sm" name="action" value="solicitarPfin">Salvar</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!--/MODAL CRIAR PFIN-->