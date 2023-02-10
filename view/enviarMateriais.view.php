<?php
include('model/EnviarMateriais.php');
include('controller/enviarMateriais.php');
?>
<div id="app">
<!--AREA ONDE ESTÁ A TABELA COM FILTROS LINHA -->  
<form method='POST' id='formFiltroMateriais'>
        <div class="container text-center">
            <div class="row mt-1">
                <div class="col-4">
                </div>
                <div class="col-4 mt-1 p-1">
                    <button type='button' class='btn btn-info btn-sm' @click="getPendencias()">Filtrar</button>
                    <button type="button" class='btn btn-danger btn-sm' @click="limparFiltros()">Limpar</button>
                    <button type="button" class='btn btn-primary btn-sm'>Estoque</button>
                </div>
            </div>
            <div class="container mt-1 mb-1">
                <div class="fundo-header-tabelas rounded d-flex justify-content-center">
                    <div class="text-dark fs-6 ">
                        <h4>Filtro {{menu}}</h4>
                    </div>
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
                            <li><input class="ml-3" type="checkbox" id="statusParcial" name="statusParcial" value="PARCIAL" /> PEFIN</label></li>
                            <li><input class="ml-3" type="checkbox" id="statusEnviado" name="statusEnviado" value="ENVIADO" /> BAIXADO</label></li>
                            <li><input class="ml-3" type="checkbox" id="statusFinalizado" name="statusFinalizado" value="FINALIZADO" /> CANCELADO</label></li>
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
                    <input type="text" class='form-control' id="produto" name="produto" placeholder="Nome do Cliente">
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
        <table data-tablesaw-sortable data-tablesaw-sortable-switch class='tablesaw table table-striped table-hover mt-1' data-tablesaw-mode='columntoggle' data-tablesaw-minimap>
        <thead class="header-tabela">
                <tr>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='5'>ID</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Filial</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='5'>Dt Ped</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='5'>Dt Fec</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Obs</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Itens Total</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Itens Parcial</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>    
            <tbody>
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


















































































































































































</div>