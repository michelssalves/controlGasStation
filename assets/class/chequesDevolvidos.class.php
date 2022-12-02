<?php

$action = $_REQUEST['p1'];

include 'conn.php';

$hoje = date('Y-m-d');
$amanha = date('Y-m-d', strtotime($hoje . ' +1 day'));

$data1 = $_REQUEST['data1'];
$data2 = $_REQUEST['data2'];
$tipoData = $_REQUEST['tipoData'];
$med = $_REQUEST['med'];
$cliente = $_REQUEST['cliente'];
$id = $_REQUEST['p2'];
$banco = $_REQUEST['banco'];

if ($id <> '') {
    $Fid = "AND ch.id = $id";
}
if ($cliente <> '') {
    $Fcliente = "AND nome LIKE '%$cliente%' ";
}
if ($banco <> '') {
    $Fbanco = "AND bco = $banco";
}
if ($med <> '') {
    $Fmed = "AND ch.id_med = $med";
}
if ($tipoData  === 0) {
    $tipoData = 'dthrInclusao';
}
if ($tipoData  === 1) {
    $tipoData = 'dtCheque';
}
if ($tipoData  === 2) {
    $tipoData = 'dtDevol';
}
if ($tipoData  === 3) {
    $tipoData = 'dtQuitacao';
}

$FtipoData = " AND $tipoData BETWEEN $data1 AND $data2 ";

$sql = "SELECT ch.id, bco, nome, nrcheque, valor, motivo, dtCheque, dtDevol, ch.dthrInclusao, ch.cpfcnpj, u.loginName, status, ultimaAlteracao, dtQuitacao
		,NOW() as hoje,hoje - dtDevol AS dias, valor, valor + (valor * 0.001 * dias) AS valorCorr, valorQuitacao 
        FROM ccp_chequeDev AS ch 
	    LEFT JOIN ti_clientes AS u ON ch.id_med = u.id AND inativo = 0 
		WHERE ch.id > 0  $FtipoData $FBanco $Fid $Fcliente $Fbanco $Fmed ORDER BY ch.id";
$qry = odbc_exec($connP, $sql);


$txtTab .= "<div class='row'>
    <div class='col-md-12'>
        <div class='d-grid gap-2 d-md-flex mt-4 justify-content-md-end'>
            <form id='xa'>
                <input type='hidden' id='filtrar'>
                <input type='hidden' name='p' id='value='2'>
                <input type='hidden' id='action' name='action' value='cheques-devolvidos'>
                <button class='btn btn-info btn-sm'>Filtrar</button>
                <button class='btn btn-danger btn-sm'>Limpar</button>
                <button class='btn btn-warning btn-sm'>Incluir</button>
        </div>
       
        <div class='table-responsive'>
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
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                            <label class='form-check-label' for='flexCheckChecked'>
                                Todos
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                            <label class='form-check-label' for='flexCheckChecked'>
                                Novo
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                            <label class='form-check-label' for='flexCheckChecked'>
                                Negociando
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                            <label class='form-check-label' for='flexCheckChecked'>
                                Quitado
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                            <label class='form-check-label' for='flexCheckChecked'>
                                PFIN
                            </label>
                        </div>
                    </td>
                
                <td>
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                        <label class='form-check-label' for='flexCheckChecked'>
                            Juridico
                        </label>
                    </div>
                </td>
                <td>
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                        <label class='form-check-label' for='flexCheckChecked'>
                            Execução
                        </label>
                    </div>
                </td>
                <td>
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                        <label class='form-check-label' for='flexCheckChecked'>
                            Caduco
                        </label>
                    </div>
                </td>
                <td>
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                        <label class='form-check-label' for='flexCheckChecked'>
                            Extraviado
                        </label>
                    </div>
                </td>
                <td>
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='checked' id='status[]' name='status[]' checked>
                        <label class='form-check-label' for='flexCheckChecked'>
                            Cancelado
                        </label>
                    </div>
                </td>
                </tr>
                <tr >
                <td colspan='2' >
                <select id='tipoData' name='tipoData' class='form-select' aria-label='Default select example'>
                    <option selected value='0'>Data Inclusão</option>
                    <option value='1'>Data Cheque</option>
                    <option value='2'>Data Devolução</option>
                    <option value='3'>Data Quitação</option>
                </select>
                </td>

                <td colspan='2'>
                <select id='filial' name='filial' required class='form-select' aria-label='Default select example'>
                    <option selected disabled value=''>Filial</option>
                    $cbFilialI 
                </select>
            </td >
            <td colspan='2'>
            <div class='input-group input-group mb-3'>
            <input type='text' name='cliente' id='cliente' placeholder='Cliente' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>
            </div>
            </td colspan='2'>

            <td>
                <div class='input-group input-group mb-3'>
                    <input type='text' name='id' id='id' placeholder='Id' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>
                </div>
            </td>
            <td>
            <div class='input-group input-group mb-3'>
                <input type='text' ame='banco' id='banco' placeholder='Banco' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>
            </div>
            </td> 
            <td><input class='form-control' type='date' name='data1' id='data1' value='$hoje'></td>
            <td><input class='form-control' type='date' name='data2' id='data2' value='$amanha'></td>
        </tr>
        </tbody>
        </table>
        </div>

  
                       
                            <hr class='border-dark'>
                            <div class='table-responsive'>
                                <table class='table table-sm table-hover table-striped fs-6 fst-italic border-dark'>
                                    <thead>
                                        <tr style='background-color:#009688'>
                                            <th>Id</th>
                                            <th>Dt Reg</th>
                                            <th>Banco</th>
                                            <th>Cliente</th>
                                            <th>Nr Cheque</th>
                                            <th>Motivo</th>
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
                                    <tbody>";

while ($row = odbc_fetch_array($qry)) {

    extract($row);
    /*  $class = '';
          $style = '';
        if ($numero % 2 == 0) {

            $class = 'p-3 mb-2 text-black';
            $style = 'style="background-color:#D3D3D3"';
        } */

    $txtTab .= "<tr class='w3-hover-red'>
                        <td>$id</td>
                        <td>";
    $txtTab .= dma($dthrInclusao);
    $txtTab .= "</td>
                        <td>$bco</td>
                        <td>";
    $txtTab .= l10($nome);
    $txtTab .= "</td>
                        <td>$nrcheque </td>
                        <td>$motivo </td>
                        <td>";
    $txtTab .= dma($dtCheque);
    $txtTab .= "</td>
                    <td>";
    $txtTab .= v2($valor);
    $txtTab .= "</td>
                        <td>";
    $txtTab .= dma($dtDevol);
    $txtTab .= "</td>
                        <td>$dias </td>
        <td>";
    $txtTab .= v2($valorCorrigido);
    $txtTab .= "</td>
                        <td>c</td>
                        <td>$loginName </td>
                        <td>";
    $txtTab .= l5($status);
    $txtTab .= "</td>
                        <td>x</td>
                    </tr>";

    $numero++;
}

$txtTab .= "            
                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>

        ";
