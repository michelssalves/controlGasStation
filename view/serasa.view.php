<?php
include('model/Serasa.php');
include('controller/serasa.php');
?>
<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE EST� A TABELA COM FILTROS LINHA 6 AT� 106-->
    <form method='POST' id='formFiltroSerasa'>
    <div class="container text-center">
            <div class="row">
                <div class="col-md-2 p-1">
                    <div class="dropdown">
                        <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusPefin" name="statusPefin" value="PEFIN" /> PEFIN</label></li>
                            <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusBaixado" name="statusBaixado" value="BAIXADO" /> BAIXADO</label></li>
                            <li><input @click="getPendencias('filtrar')" class="ml-3" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 p-1">
                    <select @change="getPendencias('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="0">Filial</option>
                        <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <select @change="getPendencias('filtrar')" id="matrizFiltro" name="matriz" class="form-select" aria-label="Default select example">
                        <option value='2'>Todos</option>
                        <option value='1'>Matriz</option>
                        <option value='0'>Meds</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <select @change="getPendencias('filtrar')" id="tipoFiltro" name="tipo" class='form-select' aria-label='Default select example'>
                        <option value='0'>Tipo</option>
                        <option value='CHEQUE'>CHEQUE</option>
                        <option value='NOTA'>NOTA</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <input @keyup="getPendencias('filtrar')" type="text" class='form-control' id="nomeClienteFiltro" name="nomeCliente" placeholder="Nome do Cliente">
                </div>
                <div class="col-md-2 mt-2">
                    <button type="button" class='btn btn-danger btn-sm' @click="limparFiltros()">Limpar</button>
                    <button type="button" class='btn btn-secondary btn-sm'>PFIN</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="fundo-header-tabelas d-flex justify-content-center">
            <div v-show="message.length > 0" class="text-dark fs-6 ">
                <h4>{{message}}</h4>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-1">
            <thead class="header-tabela">
                <tr>
                    <th>IDR</th>
                    <th>ID</th>
                    <th>MED</th>
                    <th>Tipo do Documento</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Dt de Emiss�o</th>
                    <th>Dt de Vencimento</th>
                    <th>Matriz ?</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="visualizarSerasa(pfin.id_requisicao)" v-for="(pfin, i) in pendencias" style="cursor:pointer">
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
    <!--AREA ONDE EST� A TABELA COM FILTROS -->
    <!--AREA ONDE EST�O OS MODAIS  DA LINHA 106 AT� 421-->
    <!--MODAL VISUALIZAR CX DI�RIO-->
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
                            <div v-if="status == 'CANCELADO' || status == 'BAIXADO'" class="p-1"><button type="button" title="PFIN" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                            <div class="d-flex flex-row" v-if="status != 'BAIXADO'">
                                <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="Pfin" class="btn btn-light btn-sm" :disabled="disabled" data-bs-dismiss="modal" @click="modalParaPfin(id_requisicao)"><img class="iconeSize" :src="iconPfin"></button></div>
                                <div v-if="status == 'PEFIN'" class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" :disabled="disabled" data-bs-dismiss="modal" @click="modalBaixado(id_requisicao)"><img class="iconeSize" :src="iconQuitar"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" :title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm" @click="aplicarIcon ? salvarAlteracoes(id_requisicao) : '' "><img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title" :src="aplicarIcon ? iconEdit : iconSave" /></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Observa��o" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" :disabled="disabled" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button></div>
                            </div>
                            <div class="p-1"><button type="button" @click="fecharModal()" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
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
                            <input disabled id="cnpj" name="cnpj" type="text" v-model="cnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
                            <input disabled id="cliente" name="cliente" type="text" v-model="cliente" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cidade:</span>
                            <input disabled id="cidade" name="cidade" type="text" v-model="cidade" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Bairro:</span>
                            <input disabled id="bairro" name="bairro" type="text" v-model="bairro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">CEP:</span>
                            <input disabled id="cep" name="cep" type="text" v-model="cep" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Rua:</span>
                            <input disabled id="rua" name="rua" type="text" v-model="rua" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">N�:</span>
                            <input disabled id="numero" name="numero" type="text" v-model="numero" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dt Nascimento:</span>
                            <input :readonly="readonly" id="dtNascimento" name="dtNascimento" type="date" v-model="dtNascimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Emiss�o:</span>
                            <input :readonly="readonly" id="dtEmissao" name="dtEmissao" type="date" v-model="dtEmissao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Vencimento:</span>
                            <input :readonly="readonly" id="dtVencimento" name="dtVencimento" type="date" v-model="dtVencimento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Documento:</span>
                            <select id="tipo" name="tipo" v-model="tipo" class='form-select' aria-label='Default select example'>
                                <option :value="tipo">{{tipo}}</option>
                                <option value='CHEQUE'>CHEQUE</option>
                                <option value='NOTA'>NOTA</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Valor(Inicial):</span>
                            <input :readonly="readonly" id="valorInicial" name="valorInicial" @keypress="onlyNumber" type="number" v-model="valorInicial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor(Juros):</span>
                            <input :readonly="readonly" id="valorJuros" name="valorJuros" @keypress="onlyNumber" type="number" v-model="valorJuros" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��es:</span>
                            <textarea disabled id="observacao" name="observacao" cols="60" rows="7" type="text" v-model="observacao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
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
                                                <th>DESCRI��O</th>
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
                                            <th>USU�RIO</th>
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
    <!--/MODAL VISUALIZAR CX DI�RIO-->
    <!--MODAL INCLUIR ANEXO OK-->
    <div class="modal fade" id="incluirAnexoModal" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Anexar</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="visualizarSerasa(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input id="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing">Descri��o:</span>
                                <select v-model="descricaoAnexo" id="descricaoAnexo" name="descricaoAnexo" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                    <option selected disabled value=''> SELECIONE O TIPO DE ANEXO</option>
                                    <option>ABASTECE A�</option>
                                    <option>CAIXA GERAL</option>
                                    <option>CAIXA</option>
                                    <option>CHEQUE A VISTA</option>
                                    <option>CHEQUE PR�</option>
                                    <option>COMPROVANTE DE DEP�SITO</option>
                                    <option>DECLARA��O DE ENTREGA DE CUPOM</option>
                                    <option>DESPESAS</option>
                                    <option>PLANILHA DE DEP�SITO</option>
                                    <option>POS</option>
                                    <option>REDU��O Z</option>
                                    <option>RELAT�RIO DE DESCONTOS</option>
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
    <!--MODAL INCLUIR OBSERVA��O-->
    <div class="modal fade" id="incluirObservacaoModal" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Observa��o</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="visualizarSerasa(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                        <input id="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVA��O SOBRE ESTE CAIXA</p>

                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="observacao" id="observacao" v-model="descricaoObservacao" cols="60" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" v-show="descricaoObservacao.length > 10" @click="salvarObs()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL INCLUIR OBSERVA��O-->
    <!--MODAL CANCELAR-->
    <div class="modal fade" id="modalCancelarSerasa" tabindex="-1" aria-labelledby="cancelarSerasaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Cancelamento</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="visualizarSerasa(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formCancelamento" method="POST">
                        <input id="id_requisicao" name="id" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="status" name="status" type="hidden" value="CANCELADO" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="evento" name="evento" type="hidden" value="PENDENCIA CANCELADA" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI O MOTIVO DO CANCELAMENTO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="observacaoStatus" id="observacaoStatus" v-model="observacaoStatus" cols="60" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" v-show="observacaoStatus.length > 10" @click="salvarCancelamento()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL CANCELAR-->
    <!--/MODAL BAIXAR SERASA-->
    <div class="modal fade" id="baixarSerasaModal" tabindex="-1" aria-labelledby="baixarSerasaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Anexar</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="visualizarSerasa(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formBaixarSerasa" method="POST" enctype="multipart/form-data">
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
                    <button data-bs-dismiss="modal" type="button" class="btn btn-success btn-sm" v-on:click="salvarBaixa()" v-show="filesBaixar.length > 0">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /MODAL BAIXAR SERASA-->
    <!--AREA ONDE EST�O OS MODAIS -->

</div>
<!--FIM DIV APP VUE JS-->