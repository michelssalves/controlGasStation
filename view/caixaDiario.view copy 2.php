<?php
include('model/CaixaDiario.php');
include('controller/caixaDiario.php');
?>
<div id="app">
    <div class="container">
        
    <table class='table mb-0 table-sm table-hover fs-6 fst-italic'>
        <thead>
            <tr>
                <th colspan='10' style='background-color:#009688'>
                    <center>FILTROS</center>

                </th>
            </tr>
        </thead>
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-4">
                <form method='POST' id='filtroCaixaDiario'>
                <button type='button' class='btn btn-info btn-sm' @click="getCaixas()">Filtrar</button>
                    <button type="button" class='btn btn-danger btn-sm'>Limpar</button>
                    <input type='hidden' name='p' value='4'>
                    <input type='hidden' id='action' name='action' value='filtrar-fechamento-caixa'>
                    <div class="dropdown">
                        <button class="form-select " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu p-3">
                            <li><input <?= $flagNovo ?> type="checkbox" id="statusNovo" name="statusNovo" value="NOVO" /> NOVO</label></li>
                            <li><input <?= $flagFechado ?> type="checkbox" id="statusFechado" name="statusFechado" value="FECHADO" /> FECHADO</label></li>
                            <li><input <?= $flagFechadoDefinitivo ?> type="checkbox" id="statusFechadoDefinitivo" name="statusFechadoDefinitov" value="DEFINITIVO" /> DEFINITIVO</label></li>
                            <li><input <?= $flagCancelado ?> type="checkbox" id="statusCancelado" name="statusCancelado" value="CANCELADO" /> CANCELADO</label></li>
                        </ul>
                    </div>
             
                    <select id='controleMed' name='controleMed' class='form-select' aria-label='Default select example'>
                        <option><?php echo ($controleMed ? $controleMed : 'Controle'); ?></option>
                        <option>Controle01</option>
                        <option>Controle02</option>
                        <option>Controle03</option>
                    </select>
               
                    <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
                        <option selected value="<?= ($id_med ? $id_med : ''); ?>"><?= ($nome_f[$id_med] == '' ? $nome_f[$id_med] : 'Filial'); ?></option>
                        <?= $cboMed ?>
                    </select>
            
                    <input class='form-control' type='date' name='data1' id='data1' value='<?= $data1 ?>'>
             
                    <input class='form-control' type='date' name='data2' id='data2' value='<?= $data2 ?>'>
          
                    <select id='turnoDefinitivo' name='turnoDefinitivo' class='form-select' aria-label='Default select example'>
                        <option><?php echo ($turnoDefinitivo ? $turnoDefinitivo : 'Turno Definitivo'); ?></option>
                        <option>Sim</option>
                        <option>N�o</option>
                    </select>
                    <select id='concBancaria' name='concBancaria' class='form-select' aria-label='Default select example'>
                        <option><?php echo ($concBancaria ? $concBancaria : 'Concilia��o Bancaria'); ?></option>
                        <option>Concilia��o Bancaria</option>
                        <option>Sim</option>
                        <option>N�o</option>
                    </select>
      
  
    </form>
        </div>
    </div>
    <div class="table-responsive">
        <div class="tabela-ver-todos-os-cheques">
            <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover  fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
                <thead class="header-tabela">
                    <tr>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">MED</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">DATA</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">DIA SEMANA</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">DINHEIRO</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">CHEQUE</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">BRINKS</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">PIX</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">TOTAL</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5" title="TURNOS EM DEFINITIVO">TURNOS D</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">OBS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr @click="modalVisualizar(caixa.id_requisicao)" v-for="(caixa, index) in caixas">
                        <td>{{caixa.loginName}}</td>
                        <td>{{caixa.data_caixa | dataFormatada }}</td>
                        <td>{{caixa.data_caixa | dataFormatada}}</td>
                        <td>{{caixa.dep_dinheiro | duasCasasDecimais}}</td>
                        <td>{{caixa.dep_cheque | duasCasasDecimais}}</td>
                        <td>{{caixa.dep_brinks | duasCasasDecimais}}</td>
                        <td>{{caixa.pix | duasCasasDecimais}}</td>
                        <td>{{caixa.caixa}}</td>
                        <td>{{caixa.turnos_definitivo}}</td>
                        <td>{{caixa.obs}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--MODAL VISUALIZAR CX DI�RIO-->
    <div class="modal fade" id="visualizarCaixaDiario" tabindex="-1" aria-labelledby="visualizarCaixaDiarioModalLabel" aria-hidden="true">
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
                        <div v-if="status == 'ABERTO'" class="p-1"><button type="button" title="Fechar Caixa" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconCxFechado"></button></div>
                        <div v-if="status == 'NOVO'" class="p-1"><button type="button" title="Abrir Caixa" class="btn btn-light btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconCx"></button></div>
                        <div class="p-1"><button type="button" @click="aplicarIcon ? salvarAlteracoes(id_requisicao) : '' ":title="aplicarIcon ? 'Editar Caixa' : 'Salvar'" class="btn btn-light btn-sm"><img class="iconeSize" @click="aplicarIcon = !aplicarIcon, readonly = !readonly, disabled = !disabled, title = !title"  :src="aplicarIcon ? iconEdit : iconSave" /></button></div>
                        <div class="p-1"><button type="button" title="Observa��o" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalObservacao(id_requisicao)"><img class="iconeSize" :src="iconObs"></button></div>
                        <div class="p-1"><button type="button" title="Anexo" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalAnexar(id_requisicao)"><img class="iconeSize" :src="iconAnx"></button></div>
                        <div class="p-1"><button type="button" title="Cancelar Caixa" class="btn btn-light btn-sm" data-bs-dismiss="modal" @click="modalCancelar(id_requisicao)"><img class="iconeSize" :src="iconExc"></button></div>
                        <div class="p-1"><button type="button" title="Fechar" id="botaoFechar" class="btn btn-sm" data-bs-dismiss="modal"><img class="iconeSize" :src="iconClose"></button></div>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formCaixaDiario" method="POST">
                        <div class="input-group input-group-sm mb-3">
                            <input id="id_requisicao" name="id_requisicao"  type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Dinheiro:</span>
                            <input :readonly="readonly" id="dinheiro" name="dinheiro"  type="text" v-model="dep_dinheiro" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Cheque:</span>
                            <input :readonly="readonly" id="cheque" name="cheque"  type="text" v-model="dep_cheque" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Brinks:</span>
                            <input :readonly="readonly" id="brinks" name="brinks"  type="text" v-model="dep_brinks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Pix:</span>
                            <input :readonly="readonly" id="pix" name="pix"  type="text" v-model="pix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        
                        <div class=" input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">MED:</span>
                            <select :disabled="disabled" v-model="idMed" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option :value="idMed" selected>{{ loginName }}</option>
                            <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Data</span>
                            <input :readonly="readonly" id="dataCaixa" name="dataCaixa"  type="date" v-model="data_caixa " class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Definitivo:</span>
                            <input :readonly="readonly" id="definitivo" name="definitivo"  type="text" v-model="turnos_definitivo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <span class="input-group-text" id="inputGroup-sizing">Concilia��o:</span>
                            <select :disabled="disabled" v-model="conc" id="conc" name="conc" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>{{conc}}</option>    
                                <option>SIM</option>
                                <option>N�O</option>
                            </select>
                            <span class="input-group-text" id="inputGroup-sizing">Fechamento:</span>
                            <select :disabled="disabled" v-model="caixa" id="caixa" name="caixa" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                <option>{{caixa}}</option>
                                <option>SIM</option>
                                <option>N�O</option>
                            </select>
                            
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��es:</span>
                            <textarea :readonly="readonly" id="observacao" name="observacao" cols="60" rows="7" type="text" v-model="obs" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"><?= $obs ?></textarea>
                        </div>
                </div>
                <div class="table-responsive">
                    <div class="tabela-ver-todos-os-cheques">
                        <div class="tabelaCxDiarioAnexos">
                        </div>
                    </div>
                    </br>
                    <div class="table-responsive">
                        <div class="tabela-ver-todos-os-cheques">
                            <div class="tabelaCxDiarioEventos">
                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL VISUALIZAR CX DI�RIO-->
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
                        <button type="button" title="Fechar" @click="modalVisualizar(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="incluirObservacaoForm" method="POST">
                        <input id="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        <p class="texto-de-advertencia">REGISTRE AQUI ALGUMA OBSERVA��O SOBRE ESTE CAIXA</p>

                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="observacao" id="observacao" v-model="observacao" cols="60" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" v-show="observacao.length > 10" @click="salvarObs()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/MODAL INCLUIR OBSERVA��O-->
    <!--MODAL CANCELAR-->
    <div class="modal fade" id="modalCancelarCaixa" tabindex="-1" aria-labelledby="cancelarCaixaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header fundo-cabecalho">
                    <h2 class="p-2 bg-light rounded-circle text-dark fs-4">Cancelamento</h2>
                    <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-right">
                        <button type="button" title="Fechar" @click="modalVisualizar(id_requisicao)" id="botaoFechar" class="btn" data-bs-dismiss="modal"><img :src="iconClose"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formCancelamento" method="POST">
                        <input id="id_requisicao" name="id_requisicao" type="hidden" v-model="id_requisicao" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

                        <p class="texto-de-advertencia">REGISTRE AQUI O MOTIVO DO CANCELAMENTO</p>

                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing">Observa��o:</span>
                            <textarea name="motivoCancelamento" id="motivoCancelamento" v-model="motivoCancelamento" cols="60" rows="10" style="white-space: pre;" placeholder="No min�mo 10 caracteres" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" v-show="motivoCancelamento.length > 10" @click="salvarCancelamento()" class="btn btn-outline-light btn-sm"><img :src="iconSave"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL CANCELAR-->