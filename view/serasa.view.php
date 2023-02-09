<?php
include('model/Serasa.php');
include('controller/serasa.php');
?>
<div id="app">
    <form method='POST' id='filtroSerasa'>
        <div class="container text-center">
            <div class="row mt-1">
                <div class="col-4">
                </div>
                <div class="col-4 mt-1 p-1">
                    <button type='button' class='btn btn-info btn-sm' @click="getPendencias()">Filtrar</button>
                    <button type="button" class='btn btn-danger btn-sm'>Limpar</button>
                    <button type="button" class='btn btn-secondary btn-sm'>PFIN</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input class="ml-3" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input class="ml-3" type="checkbox" id="statusPefin" name="statusPefin" value="PEFIN" /> PEFIN</label></li>
                            <li><input class="ml-3" type="checkbox" id="statusBaixado" name="statusBaixado" value="BAIXADO" /> BAIXADO</label></li>
                            <li><input class="ml-3" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <select id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="0">Filial</option>
                        <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                    </select>
                </div>
                <div class="col">
                    <select id="matrizFiltro" name="matriz" class="form-select" aria-label="Default select example">
                        <option value='2'>Todos</option>
                        <option value='1'>Matriz</option>
                        <option value='0'>Meds</option>
                    </select>
                </div>
                <div class="col">
                    <select id="tipoFiltro" name="tipo" class='form-select' aria-label='Default select example'>
                        <option value='0'>Tipo</option>
                        <option value='Cheque'>Cheque</option>
                        <option value='Nota'>Nota</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" class='form-control' id="nomeClienteFiltro" name="nomeCliente" placeholder="Nome do Cliente">
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-2">
            <thead class="header-tabela">
                <tr>
                    <th>IDR</th>
                    <th>ID</th>
                    <th>MED</th>
                    <th>Tipo do Documento</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Dt de Emissão</th>
                    <th>Dt de Vencimento</th>
                    <th>Matriz ?</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="visualizarPendencia(pfin.id_requisicao)" v-for="(pfin, i) in pendencias" style="cursor:pointer">
                    <td>{{pfin.id_requisicao}}</td>
                    <td>{{pfin.id}}</td>
                    <td>{{pfin.loginName}}</td>
                    <td>{{pfin.tipo}}</td>
                    <td>{{pfin.nomeCliente | upper}}</td>
                    <td>{{pfin.valor | duasCasasDecimais}}</td>
                    <td>{{pfin.dataEmissao | dataFormatada}}</td>
                    <td>{{pfin.dataVencimento | dataFormatada}}</td>
                    <td>{{pfin.ematriz}}</td>
                </tr>
            </tbody>
        </table>

        <nav aria-label="Page navigation example" style="cursor:pointer">
            <ul class="pagination pagination-sm justify-content-center">
                <li class="page-item">
                    <a class="page-link" @click="paginaAtual = 1">Primeira</a>
                </li>
                <li class="page-item" v-if="paginaAtual - 1 > 0" @click="paginaAtual--">
                    <a class="page-link">{{paginaAtual - 1}}</a>
                </li>
                <li class="page-item active">
                    <a class="page-link">{{ paginaAtual }}</a>
                </li>
                <li class="page-item" v-if="paginaAtual + 1 <= totalResults" @click="paginaAtual++">
                    <a class="page-link">{{paginaAtual + 1}}</a>
                </li>
                <li class="page-item">
                    <a class="page-link" @click="paginaAtual = totalResults">Ultima</a>
                </li>
            </ul>
        </nav>
    </div>
    <!--MODAL VISUALIZAR CX DIÁRIO-->
    <div class="modal fade" id="visualizarSerasa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerSerasa" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-light rounded-circle text-dark fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-light rounded-circle text-dark fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="Pfin" class="btn btn-light btn-sm" :disabled="disabled" :data-bs-dismiss="readonly ? modal : ''" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                            <div v-if="status == 'PEFIN'" class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" :disabled="disabled" :data-bs-dismiss="readonly ? modal : ''" @click="modalQuitar(id_requisicao)"><img class="iconeSize" :src="iconQuitar"></button></div>
                            <div class="p-1"><button type="button" :title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm" @click="aplicarIcon ? salvarAlteracoes(id_requisicao, 'alterarCaixa') : '' "><img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title" :src="aplicarIcon ? iconEdit : iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button></div>
                            <div class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button></div>
                            <div class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button></div>
                            <div class="p-1"><button type="submit" title="Fechar" id="botaoFechar" class="btn btn-sm" :disabled="!disabled"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <input id="id_requisicao" name="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CPF/CNPJ:</span>
                            <input :readonly="readonly" id="cnpj" name="cnpj" type="text" v-model="cnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
                            <input :readonly="readonly" id="cliente" name="cliente" type="text" v-model="cliente" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input :readonly="readonly" id="cidade" name="cidade" type="text" v-model="cidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input :readonly="readonly" id="bairro" name="bairro" type="text" v-model="bairro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input :readonly="readonly" id="cep" name="cep" type="text" v-model="cep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Rua:</span>
                            <input :readonly="readonly" id="rua" name="rua" type="text" v-model="rua" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Rua:</span>
                            <input :readonly="readonly" id="numero" name="numero" type="text" v-model="numero" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dt Nascimento:</span>
                            <input :readonly="readonly" id="dtNascimento" name="dtNascimento" type="date" v-model="dtNascimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Emissão:</span>
                            <input :readonly="readonly" id="dtEmissao" name="dtEmissao" type="date" v-model="dtEmissao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Vencimento:</span>
                            <input :readonly="readonly" id="dtVencimento" name="dtVencimento" type="date" v-model="dtVencimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Documento:</span>
                            <input :readonly="readonly" id="tipo" name="tipo" type="text" v-model="tipo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor(Inicial):</span>
                            <input :readonly="readonly" id="valorInicial" name="valorInicial" type="text" v-model="valorInicial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor(Juros):</span>
                            <input :readonly="readonly" id="valorJuros" name="valorJuros" type="text" v-model="valorJuros" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observações:</span>
                            <textarea :readonly="readonly" id="observacao" name="observacao" cols="60" rows="7" type="text" v-model="observacao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                        </div>
                        <div class="container">
                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-striped table-hover mt-2">
                                        <thead class="header-tabela">
                                            <tr>
                                                <th>DATA</th>
                                                <th>USUARIO</th>
                                                <th>OBS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="obs in observacoeSerasa">
                                                <td>{{obs.datahora}}</td>
                                                <td>{{obs.usuario}}</td>
                                                <td>{{obs.obs}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-striped table-hover mt-2">
                                        <thead class="header-tabela">
                                            <tr>
                                                <th>DESCRIÇÃO</th>
                                                <th>DOCUMENTO</th>
                                                <th>EXT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr @click="newTab(anexo.id)" style="cursor:pointer" v-for="anexo in anexoSerasa">
                                                <td>{{anexo.descricao}}</td>
                                                <td>{{anexo.numDoc}}</td>
                                                <td>{{anexo.extensao}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>EVENTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="evento in eventoSerasa">
                                            <td>{{evento.datahora}}</td>
                                            <td>{{evento.evento}}</td>
                                            <td>{{evento.usuario}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                        </div>
                </div>
            </div>
        </form>
    </div>

    <!--/MODAL VISUALIZAR CX DIÁRIO-->
    <!--MODAL INCLUIR ANEXO OK-->
    <div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Anexar</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="modalVisualizar(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input id="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Descrição:</span>
                                <select v-model="descricaoAnexo" id="descricaoAnexo" name="descricaoAnexo" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                    <option selected disabled value=''> SELECIONE O TIPO DE ANEXO</option>
                                    <option>ABASTECE AÍ</option>
                                    <option>CAIXA GERAL</option>
                                    <option>CAIXA</option>
                                    <option>CHEQUE A VISTA</option>
                                    <option>CHEQUE PRÉ</option>
                                    <option>COMPROVANTE DE DEPÓSITO</option>
                                    <option>DECLARAÇÃO DE ENTREGA DE CUPOM</option>
                                    <option>DESPESAS</option>
                                    <option>PLANILHA DE DEPÓSITO</option>
                                    <option>POS</option>
                                    <option>REDUÇÃO Z</option>
                                    <option>RELATÓRIO DE DESCONTOS</option>
                                    <option>RESIDUAL</option>
                                    <option>TEF</option>
                                    <option>VALES</option>
                                    <option>TESTE</option>
                                </select>
                            </div>
                            <div class="container">
                                <div v-if="files.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(file, key) in files" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ file.name }}
                                    <div class="success-container" v-if="file.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFile(key)"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" type="button" class="btn btn-success btn-sm" v-on:click="salvarAnexo()" v-show="files.length > 0">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL INCLUIR ANEXO-->
    <!--MODAL INCLUIR OBSERVAÇÃO-->
    <div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Observação</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="modalVisualizar(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                        <input id="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVAÇÃO SOBRE ESTE CAIXA</p>

                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="observacao" id="observacao" v-model="descricaoObservacao" cols="60" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" v-show="descricaoObservacao.length > 10" @click="salvarObs()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL INCLUIR OBSERVAÇÃO-->






























</div>