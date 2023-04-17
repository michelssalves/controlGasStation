<div id="app">
    <div class="tableArea">
        <form method='POST' id='formChequesDevolvidos'>
            <div class="container">
                <div class="row">
                    <div class="col-md-1 p-1">
                        <div class="dropdown">
                            <button class="form-select " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu p-3">
                                <li><input checked="true" @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusNegociando" name="statusNegociando" value="NEGOCIANDO" /> NEGOCIANDO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusQuitado" name="statusQuitado" value="QUITADO" /> QUITADO</label></li>
                                <li><input checked="true" @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusPfin" name="statusPfin" value="PFIN" /> PFIN</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusJuridico" name="statusJuridico" value="JURIDICO" /> JURIDICO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusExecucao" name="statusExecucao" value="EXECUÇÃO" /> EXECUÇÃO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusCaducou" name="statusCaducou" value="CADUCOU" /> CADUCOU</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusExtraviado" name="statusExtraviado" value="EXTRAVIADO" /> EXTRAVIADO</label></li>
                                <li><input @click="getChequeDevolvidos('filtrar')" type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getChequeDevolvidos('filtrar')" id='tipoData' name='tipoData' class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option selected value='0'>Data Inclusão</option>
                            <option value='1'>Data Cheque</option>
                            <option value='2'>Data Devolução</option>
                            <option value='3'>Data Quitação</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select @change="getChequeDevolvidos('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">Filial</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <input class='form-control' type='date' name='data1' id='data1' v-model="data1">
                    </div>
                    <div class="col-md-2 p-1">
                        <input class='form-control' type='date' name='data2' id='data2' v-model="data2">
                    </div>
                    <div class="col-md-2 p-1">
                        <button type="button" class='btn btn-light btn-sm' @click="limparFiltros()"><img class="iconeSize" :src="iconLimpar"></button>
                        <button type="button" class='btn btn-light btn-sm'><img class="iconeSize" :src="iconCreate"></button>
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
                <table class="table table-striped table-hover mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>Dt Reg</th>
                            <th>Cliente</th>
                            <th>Nr Cheque</th>
                            <th>Dt Cheque</th>
                            <th>Valor</th>
                            <th>Dt Devol</th>
                            <th>Dias</th>
                            <th>$ Corr</th>
                            <th>Dt Quit</th>
                            <th>Med</th>
                            <th>Stat</th>
                            <th>UltAlt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="modalVisualizar(cheque.id)" v-for="(cheque, index) in chequesDevolvidos">
                            <td>{{cheque.dthrInclusao}}</td>
                            <td :title="cheque.nomeCliente">{{cheque.nome}}</td>
                            <td>{{cheque.nrcheque}}</td>
                            <td>{{cheque.dtCheque}}</td>
                            <td>{{cheque.valor | duasCasasDecimais}}</td>
                            <td>{{cheque.dataDevolucao}}</td>
                            <td>{{cheque.dias}}</td>
                            <td>{{cheque.valorCorr | duasCasasDecimais}}</td>
                            <td>{{cheque.dtQuitacao}}</td>
                            <td>{{cheque.loginName}}</td>
                            <td>{{cheque.status}}</td>
                            <td>{{cheque.ultimaAlteracao}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
        </form>
    </div>
    <!--MODAL VISUALIZAR CHEQUE-->
    <div class="modal fade w3-animate-top" id="visualizarCheque" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visualizarSerasaoModalLabel" aria-hidden="true">
        <form id="formVerCheque" method="POST">
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
                            <div v-if="status != 'CANCELADO'" class="d-flex flex-row">
                                <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="PFIN" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="statusPfin(id)"><img class="iconeSize" :src="iconPfin"></button></div>
                                <div v-if="status == 'PFIN'" class="p-1"><button type="button" title="Quitar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalQuitar(id)"><img class="iconeSize" :src="iconFinalizar"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Observação" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id)"><img class="iconeSize" :src="iconObs"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id)"><img class="iconeSize" :src="iconAnx"></button></div>
                                <div v-if="status != 'CANCELADO'" class="p-1"><button type="button" title="Cancelar" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(id)"><img class="iconeSize" :src="iconExc"></button></div>
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
                            <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Filial:</span>
                            <input disabled id="loginName" name="loginName" type="text" v-model="loginName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Banco:</span>
                            <input disabled id="banco" name="banco" type="text" v-model="banco" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Cliente:</span>
                            <input disabled id="nome" name="nome" type="text" v-model="nome" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">CNPJ:</span>
                            <input disabled id="cpfcnpj" name="cpfcnpj" type="text" v-model="cpfcnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                            <span class="input-group-text" id="inputGroup-sizing">Telefone:</span>
                            <input disabled id="telefone" name="telefone" type="text" v-model="telefone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Nº Cheque:</span>
                            <input disabled id="nrcheque" name="nrcheque" type="text" v-model="nrcheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Valor:</span>
                            <input disabled id="valor" name="valor" type="text" v-model="valor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Qui:</span>
                            <input disabled id="dtQuitacao" name="dtQuitacao" type="date" v-model="dtQuitacao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Motivo:</span>
                            <input disabled id="motivo" name="motivo" type="text" v-model="motivo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Dt Cri:</span>
                            <input disabled id="dthrInclusao" name="dthrInclusao" type="date" v-model="dthrInclusao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Chq:</span>
                            <input disabled id="dtCheque" name="dtCheque" type="date" v-model="dtCheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dt Dev:</span>
                            <input disabled id="dtDevol" name="dtDevol" type="date" v-model="dtDevol" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="container">
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>OBS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer" v-for="observacao in observacoes">
                                            <td>{{observacao.datahora}}</td>
                                            <td>{{observacao.usuario}}</td>
                                            <td>{{observacao.obs}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>DESCRICÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="newTab(anexo.idAnexo)" style="cursor:pointer" v-for="anexo in anexos">
                                            <td>{{anexo.datahora}}</td>
                                            <td>{{anexo.usuario}}</td>
                                            <td>{{anexo.descricao}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-striped table-hover mt-2">
                                    <thead class="header-tabela">
                                        <tr>
                                            <th>DATA</th>
                                            <th>USUÁRIO</th>
                                            <th>DESCRICÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="evento in eventos">
                                            <td>{{evento.datahora}}</td>
                                            <td>{{evento.usuario}}</td>
                                            <td>{{evento.evento}}</td>
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
    <!--/MODAL VISUALIZAR CHEQUE-->
    <!--MODAL INCLUIR ANEXO -->
    <div class="modal fade w3-animate-top" id="incluirAnexoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirAnexoModalLabel" aria-hidden="true">
        <form id="formAnexar" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarAnexo('gravarAnexo')" class="btn btn-light btn-sm" v-show="files.length > 0" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id)" class="btn btn-sm" id="botaoFechar" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="hidden" v-model="actionAnexar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
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
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR ANEXO-->
    <!--MODAL INCLUIR OBSERVAÇÃO-->
    <div class="modal fade w3-animate-top" id="incluirObservacaoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="incluirObservacaoModalLabel" aria-hidden="true">
        <form id="incluirObservacaoForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Observação</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarObservacao()" class="btn btn-light btn-sm" v-show="observacao.length > 10" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id)" class="btn btn-sm" id="botaoFechar" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="hidden" v-model="actionObs" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observação:</span>
                            <textarea name="observacao" id="observacao" v-model="observacao" cols="80" rows="10" style="white-space: pre;" placeholder="No minímo 10 caracteres" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/MODAL INCLUIR OBSERVAÇÃO-->
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
    <!--MODAL QUITAR-->
    <div class="modal fade w3-animate-top" id="modalQuitarCheque" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="quitarChequeModalLabel" aria-hidden="true">
        <form id="formQuitar" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input id="id" name="id" type="hidden" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    <div class="modal-header fundo-cabecalho">
                        <div class="d-flex flex-row">
                            <div class="d-none d-md-block">
                                <h2 class="p-2 bg-dark rounded-circle text-light fs-4">Anexar</h2>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-1"><button type="button" title="Salvar" @click="salvarAnexoQuitar()" class="btn btn-light btn-sm" v-show="filesQuitar.length > 0" data-bs-dismiss="modal"><img class="iconeSize" :src="iconSave"></button></div>
                            <div class="p-1"><button type="button" title="Fechar" @click="voltarVisualizar(id)" class="btn btn-sm" id="botaoFechar" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input id="action" name="action" type="text" v-model="actionQuitar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <input id="id" name="id" type="text" v-model="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <div class="mb-3">
                            <div class="container">
                                <p><strong>Anexar comprovante para confirmar quitação</strong></p>
                                <div v-if="filesQuitar.length == 0" class="large-12 medium-12 small-12 filezone">
                                    <input type="file" id="filesQuitar" ref="filesQuitar" multiple v-on:change="handleFilesQuitar()" />
                                    <p>
                                        Arraste aqui <br>ou clique para procurar
                                    </p>
                                </div>

                                <div v-for="(fileQ, key) in filesQuitar" class="file-listing">
                                    <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                    {{ fileQ.name }}
                                    <div class="success-container" v-if="fileQ.id > 0">

                                    </div>
                                    <div class="remove-container" v-else>
                                        <a class="remove" v-on:click="removeFileQuitar(key)"><i class="fa-regular fa-trash-can"></i></a>
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
    <!--/MODAL QUITAR-->
</div>