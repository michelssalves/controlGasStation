<?php
include('model/Depositos.php');
include('controller/depositos.php');
?>
<div id="app">
    <form method='POST' id='formulario-caixa-diario'>
        <div class="container text-center p-2">
            <div class="row">
                <div class="col-md-3 p-1">
                    <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
            
                    </select>
                </div>
                <div class="col-md-3 p-1">
                    <select required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                        <option>CONTA</option>
                        <option>BB</option>
                        <option>BB MEDS</option>
                        <option>BB PROPRIO</option>
                        <option>ITAU</option>
                        <option>BRINKS</option>
                        <option>PROSEGUR</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <input type='date' class='form-control' name='dataIni' id='dataIni'>
                </div>
                <div class="col-md-2 p-1">
                    <input type='date' class='form-control' name='dataFim' id='dataFim'>
                </div>
                <div class="col-md-1 p-1 mt-1">
                    <button type="button" class='btn btn-danger btn-sm'>Limpar</button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
            <table class="table table-striped table-hover mt-1 ">
                <thead class="header-tabela">
                <tr>
                    <td>DT MOV</td>
                    <td>DT MOV</td>
                    <td>DIA SEM</td>
                    <td>MED</td>
                    <td>DINHEIRO</td>
                    <td>CONTA DIN</td>
                    <td>CHEQUE</td>
                    <td>CONTA CH</td>
                    <td>TOTAL DEP</td>
                    <td>DÉBITO</td>
                    <td>DT REG</td>
                    <td>OBS</td>
                </tr>
            </thead>
            <tbody>
                    <th>DT MOV</th>
                    <th>DT MOV</th>
                    <th>DIA SEM</th>
                    <th>MED</th>
                    <th>DINHEIRO</th>
                    <th>CONTA DIN</th>
                    <th>CHEQUE</th>
                    <th>CONTA CH</th>
                    <th>TOTAL DEP</th>
                    <th>DÉBITO</th>
                    <th>DT REG</th>
                    <th>OBS</th>
            </tbody>
        </table>
    </div>

</div>