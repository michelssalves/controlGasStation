<?php
include('model/Serasa.php');
include('controller/serasa.php');
?>
<form method="get">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-4">
                <input type='hidden' name='p' value='5'>
                <input type='hidden' id='action' name='action' value='filtrar-fechamento-caixa'>
                <button type="submit" name="acao" value="filtrar" class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" name="acao" value="limpar" class='btn btn-danger btn-sm'>Limpar</button>
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
                                <li><input class="ml-3" type="checkbox" name="statusTodos" value="statusCancelado" /> TODOS</label></li>
                                <li><input class="ml-3" type="checkbox" name="statusNovo" value="statusCancelado" /> NOVO</label></li>
                                <li><input class="ml-3" type="checkbox" name="statusPefin" value="statusCancelado" /> PEFIN</label></li>
                                <li><input class="ml-3" type="checkbox" name="statusPago" value="statusCancelado" /> PAGO</label></li>
                                <li><input class="ml-3" type="checkbox" name="statusBaixado" value="statusBaixado" /> BAIXADO</label></li>
                                <li><input class="ml-3" type="checkbox" name="statusCancelado" value="statusPago" /> CANCELADO</label></li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <select name="matriz" class="form-select" aria-label="Default select example">
                            <option selected>Todos</option>
                            <option>Matriz</option>
                            <option>Meds</option>
                        </select>
                    </td>
                    <td>
                        <select name="med" class='form-select' aria-label='Default select example'>
                            <option selected value="0">Med</option>
                        </select>
                    </td>
                    <td>
                        <select name="tipo" class='form-select' aria-label='Default select example'>
                            <option selected>Tipo</option>
                            <option>Nota</option>
                            <option>Cheque</option>
                        </select>
                    </td>
                    <td><input type="text" class='form-control' name="nomeCliente" placeholder="Nome do Cliente"></td>
                    <td><input type="text" class='form-control' name="cnpj" placeholder="CPF/CNPJ Cliente"></td>
                    <td><input type="text" class='form-control' name="valor" placeholder="Valor"></td>
                </tr>
            </tbody>
        </table>
</form>
<div class="table-responsive">
    <div class="tabela-ver-todos-os-cheques">
        <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover  fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
            <thead class="header-tabela">
            <tr >
                <th data-tablesaw-sortable-col data-tablesaw-priority="1">MED</th>
                <th data-tablesaw-sortable-col data-tablesaw-priority="1">Tipo do Documento</th>
                <th data-tablesaw-sortable-col data-tablesaw-priority="1">Nome do Cliente</th>
                <th data-tablesaw-sortable-col data-tablesaw-priority="1">Valor</th>
                <th data-tablesaw-sortable-col data-tablesaw-priority="5">Data de Emissão</th>
                <th data-tablesaw-sortable-col data-tablesaw-priority="5">Data de Vencimento</th>
                <th data-tablesaw-sortable-col data-tablesaw-priority="1">Serasa Matriz</th>
            </tr>
        </thead>
        <tbody>
            <?= $txtTable ?>
        </tbody>
    </table>
</div>
