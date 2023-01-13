<?php
include('../view/partials/head.php');
include('model/Serasa.php');
include('controller/serasa.php');
?>
<form method="POST">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-4">
                <input type='hidden' name='p' value='5'>
                <button type="submit" name="action" value="filtrar-serasa" class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" name="action" value="limpar" class='btn btn-danger btn-sm'>Limpar</button>
                <button type="button" data-bs-toggle='modal' data-bs-target='#criaNovoPfin' style='cursor:pointer' class='btn btn-secondary btn-sm'>PFIN</button>
            </div>
        </div>
    </div>
    <table class='table mb-0 table-sm table-hover fs-6 fst-italic'>
            <thead>
                <tr>
                    <th colspan='10' style='background-color:#009688'>
                        <center>FILTROS</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="dropdown">
                            <button class="form-select" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu">
                                <li><input class="ml-3" type="checkbox" id="statusNovo" name="statusNovo" value="statusNovo"/> NOVO</label></li>
                                <li><input class="ml-3" type="checkbox" id="statusPefin" name="statusPefin" value="statusPefin" /> PEFIN</label></li>
                                <li><input class="ml-3" type="checkbox" id="statusPago" name="statusPago" value="statusPago" /> PAGO</label></li>
                                <li><input class="ml-3" type="checkbox" id="statusBaixado" name="statusBaixado" value="statusBaixado"  /> BAIXADO</label></li>
                                <li><input class="ml-3" type="checkbox" id="statusCancelado" name="statusCancelado" value="statusCancelado" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <select id="matrizFiltro" name="matriz" class="form-select" aria-label="Default select example">
                            <option selected>Todos</option>
                            <option>Matriz</option>
                            <option>Meds</option>
                        </select>
                    </td>
                    <td>
                        <select id="medFiltro" name="med" class='form-select' aria-label='Default select example'>
                            <option selected value="0">Med</option>
                            <?= $cboMed ?>
                        </select>
                    </td>
                    <td>
                        <select id="tipoFiltro" name="tipo" class='form-select' aria-label='Default select example'>
                            <option selected>Tipo</option>
                            <option>Nota</option>
                            <option>Cheque</option>
                        </select>
                    </td>
                    <td><input type="text" class='form-control' id="nomeClienteFiltro" name="nomeCliente" placeholder="Nome do Cliente"></td>
            
                </tr>
            </tbody>
        </table>
</form>
<div class="table-responsive">
    <div class="tabela-ver-todos-os-cheques">
    <table data-tablesaw-sortable data-tablesaw-sortable-switch class='tablesaw table-sm table-hover  fs-6 mb-0' data-tablesaw-mode='columntoggle' data-tablesaw-minimap>
    <thead class='header-tabela'>
        <tr>
            <th data-tablesaw-sortable-col data-tablesaw-priority='1'>ID</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='1'>MED</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Tipo do Documento</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Cliente</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Valor</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='5'>Dt de Emissão</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='5'>Dt de Vencimento</th>
            <th data-tablesaw-sortable-col data-tablesaw-priority='1'>Matriz ?</th>
        </tr>
    </thead>
    <tbody>
        <?= $txtTable ?>
   
         </div>
        </div>
