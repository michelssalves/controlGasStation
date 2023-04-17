<!--INICIO DIV APP VUE JS-->
<div id="app">
    <!--AREA ONDE EST� A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroCaixaDiario'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <input @keyup="getCaixas('filtrar')" class='form-control' type='date' id='data1' name="data1" v-model="filtroData1">
                    </div>
                    <div class="col-md-2 p-1">
                        <input @keyup="getCaixas('filtrar')" class='form-control' type='date' id='data2' name="data2" v-model="filtroData2">
                    </div>
                    <div class="col-md-1 p-1">
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-3">
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusAberto" name="statusAberto" value="ABERTO" /> ABERTO</label></li>
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusFechado" name="statusFechado" value="FECHADO" /> FECHADO</label></li>
                                <li><input @click="getCaixas('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getCaixas('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getCaixas('filtrar')" id='turnoDefinitivo' name='turnoDefinitivo' class='form-select' aria-label='Default select example'>
                            <option value='0'>Turno</option>
                            <option value='SIM'>Sim</option>
                            <option value='NAO'>N�o</option>
                        </select>
                    </div>
                    <div class="col-md-1 p-1">
                        <select @change="getCaixas('filtrar')" id='concBancaria' name='concBancaria' class='form-select' aria-label='Default select example'>
                            <option value='0'>Conci</option>
                            <option value='SIM'>Sim</option>
                            <option value='NAO'>N�o</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="modalCriarCaixa()"><img class="iconeSize" :src="iconCreate"></button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="fundo-header-tabelas d-flex justify-content-center">
                    <div v-show="message.length > 0" class="text-dark fs-6 ">
                        <h4>{{message}}</h4>
                    </div>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table table-striped table-hover">
                    <thead class="header-tabela">
                        <tr>
                            <th>ID</th>
                            <th>STATUS</th>
                            <th>MED</th>
                            <th>DATA</th>
                            <th>DINHEIRO</th>
                            <th>CHEQUE</th>
                            <th>BRINKS</th>
                            <th>PIX</th>
                            <th>TOTAL</th>
                            <th title="TURNOS EM DEFINITIVO">TURNO</th>
                            <th>OBS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(caixa.id_requisicao)" style="cursor:pointer" v-for="(caixa, i, x) in caixas">
                            <td>{{caixa.id_requisicao}}</td>
                            <td>{{caixa.status}}</td>
                            <td>{{caixa.loginName}}</td>
                            <td>{{caixa.data_caixa | dataFormatada }}</td>
                            <td>{{caixa.dep_dinheiro | duasCasasDecimais}}</td>
                            <td>{{caixa.dep_cheque | duasCasasDecimais}}</td>
                            <td>{{caixa.dep_brinks | duasCasasDecimais}}</td>
                            <td>{{caixa.pix | duasCasasDecimais}}</td>
                            <td>{{caixa.soma}}</td>
                            <td>{{caixa.turnos_definitivo}}</td>
                            <td>{{caixa.obs}}</td>
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
        </form>
    </div>
    <!--/AREA ONDE EST� A TABELA E FILTROS-->
    <!--MODAL VISUALIZAR CX DI�RIO-->
    <div class="modal fade w3-animate-top" id="visualizarCaixaDiario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarCaixaDiarioModalLabel" aria-hidden="true">
        <form id="formCaixaDiario" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ title ? 'Visualizando' : 'Editando' }}</h2>
                            </div>
                            <h2 class="p-2 bg-dark rounded-circle text-light fs-6">{{ status }}</h2>
                        </div>
                        <div class="d-flex flex-row">
                            <div v-if="status == 'ABERTO'" class="p-1">
                                <button type="button" title="Fechar Caixa" :disabled="disabled" class="btn btn-light btn-sm" :data-bs-dismiss="readonly ? modal : ''" @click="modalFecharCaixa(id_requisicao, 'Fechar')"><img class="iconeSize" :src="iconCxFechado"></button>
                            </div>
                            <div v-if="status == 'NOVO'" class="p-1">
                                <button type="button" title="Abrir Caixa" :disabled="disabled" class="btn btn-light btn-sm" :data-bs-dismiss="readonly ? modal : ''" @click="modalAbrirCaixa(id_requisicao, 'Abrir')"><img class="iconeSize" :src="iconCx"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" :title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm" @click="aplicarIcon ? salvarAlteracoes(id_requisicao, 'alterarCaixa') : '' ">
                                    <img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title" :src="aplicarIcon ? iconEdit : iconSave" /></button>
                            </div>
                            <div v-if="!(status == 'FECHADO' || status == 'CANCELADO')" class="p-1">
                                <button type="button" title="Observa��o" :disabled="disabled" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Anexo" :disabled="disabled" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button>
                            </div>
                            <div v-if="!(status == 'FECHADO' || status == 'CANCELADO')" class="p-1">
                                <button type="button" title="Cancelar Caixa" :disabled="disabled" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button>
                            </div>
                            <div class="p-1">
                                <button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal">
                                    <img class="iconeSize" :src="iconClose"></button>
                            </div>
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
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro:</span>
                            <input :readonly="readonly" id="dinheiro" name="dinheiro" type="text" v-model="dep_dinheiro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                            <input :readonly="readonly" id="cheque" name="cheque" type="text" v-model="dep_cheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Brinks:</span>
                            <input :readonly="readonly" id="brinks" name="brinks" type="text" v-model="dep_brinks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Pix:</span>
                            <input :readonly="readonly" id="pix" name="pix" type="text" v-model="pix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class=" input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">MED:</span>
                            <select :disabled="disabled" v-model="idMed" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="idMed" selected>{{ loginName }}</option>
                                <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Data</span>
                            <input :readonly="readonly" id="dataCaixa" name="dataCaixa" type="date" v-model="data_caixa " class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Definitivo:</span>
                            <input :readonly="readonly" id="definitivo" name="definitivo" type="text" v-model="turnos_definitivo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Concilia��o:</span>
                            <select :disabled="disabled" v-model="conc" id="conc" name="conc" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="conc">{{conc}}</option>
                                <option>SIM</option>
                                <option>N�O</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Fechamento:</span>
                            <select :disabled="disabled" v-model="caixa" id="caixa" name="caixa" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option :value="caixa">{{caixa}}</option>
                                <option>SIM</option>
                                <option>N�O</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��es:</span>
                            <textarea disabled id="observacao" name="observacao" cols="60" rows="7" type="text" v-model="obs" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                        </div>
                        <div class="container">
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>STATUS</th>
                                            <th>TIPO</th>
                                            <th>DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="newTab(anexoCaixa.id, anexoCaixa.extensao)" style="cursor:pointer" v-for="(anexoCaixa, i) in anexosCaixa">
                                            <td>{{anexoCaixa.descricao}}</td>
                                            <td>{{anexoCaixa.extensao}}</td>
                                            <td>{{anexoCaixa.dthr_anexo}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>USUARIO</th>
                                            <th>OBS</th>
                                            <th>DATA</th>
                                            <th>GERADO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="(eventoCaixa, i) in eventosCaixa">
                                            <td>{{eventoCaixa.usuario}}</td>
                                            <td>{{eventoCaixa.obs}}</td>
                                            <td>{{eventoCaixa.datahora}}</td>
                                            <td>{{eventoCaixa.gerado}}</td>
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
    <div class="modal fade w3-animate-top" id="incluirAnexoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <form method="POST" id="formAnexoAdicional" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarAnexoAdicional()" v-show="filesAnexar.length > 0" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id_requisicao)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="hidden" v-model="actionAnexar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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
                                <div v-if="filesAnexar.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="filesAnexar" ref="filesAnexar" multiple v-on:change="handleFilesAnexar()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(file, key) in filesAnexar" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ file.name }}
                                    <div class="success-container" v-if="file.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFileAnexar(key)"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR ANEXO-->
    <!--MODAL INCLUIR OBSERVA��O-->
    <div class="modal fade w3-animate-top" id="incluirObservacaoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <form id="incluirObservacaoForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Observa��o</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Fechar" @click="salvarObs()" v-show="descricaoObservacao.length > 10" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id_requisicao)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVA��O SOBRE ESTE PEDIDO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="observacao" id="observacao" v-model="descricaoObservacao" cols="80" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR OBSERVA��O-->
    <!--MODAL CANCELAR-->
    <div class="modal fade w3-animate-top" id="modalCancelarCaixa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelarCaixaModalLabel" aria-hidden="true">
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
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarCancelamento()" v-show="motivoCancelamento.length > 10" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id_requisicao)" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">

                        <input id="id_requisicao" name="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <p class="texto-de-advertencia">REGISTRE AQUI O MOTIVO DO CANCELAMENTO</p>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="motivoCancelamento" id="motivoCancelamento" v-model="motivoCancelamento" cols="80" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CANCELAR-->
    <!--MODAL CRIAR FECHAMENTO-->
    <div class="modal fade w3-animate-top" id="criarCaixa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="criarCaixaModalLabel" aria-hidden="true">
        <form id="formCriarCaixa" method="POST">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Criar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarFechamento()" class="btn btn-light btn-sm"><img class="iconeSize" :src="iconSave" /></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="fecharModal()" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <div v-show="message.length > 0" class="bg-success rounded-circle text-dark fs-6 p-3">
                            <h2>{{message}}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <input id="action" name="action" type="hidden" v-model="actionCriar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro:</span>
                            <input id="dinheiro" name="dinheiro" type="text" v-model="criarDinheiro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                            <input id="cheque" name="cheque" type="text" v-model="criarCheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Brinks:</span>
                            <input id="brinks" name="brinks" type="text" v-model="criarBrinks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Pix:</span>
                            <input id="pix" name="pix" type="text" v-model="criarPix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Data</span>
                            <input name="dataCaixa" id="dataCaixa" v-model="criarData" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Turno Definitivo:</span>
                            <select required v-model="criarTurnoDefinitivo" name='turnos_definitivo' id='turnos_definitivo' class='form-select' aria-label='Default select example'>
                                <option value="">Escolha</option>
                                <option>SIM</option>
                                <option>N�O</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <textarea name="criarObs" id="criarObs" v-model="criarObs" cols="80" rows="2" style="white-space: pre;" placeholder="Observa��o" maxlength="500" required></textarea>
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
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL CRIAR FECHAMENTO-->
</div>
<!--FIM DIV APP VUE JS-->