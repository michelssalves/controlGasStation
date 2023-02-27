<?php
include('model/Depositos.php');
include('controller/depositos.php');
?>
<div id="app">
    <form method='POST' id='formularioDepositos'>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-3 p-1">
                    <select @change="getDepositos('filtrar')" id="idMed" name="idMed" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                        <option value="0">Filial</option>
                        <option v-for="med in meds" :key="med.id" :value="med.id">{{ med.nomecompleto }}</option>
                    </select>
                </div>
                <div class="col-md-3 p-1">
                    <select @change="getDepositos('filtrar')" required id='contaDeposito' name='contaDeposito' class='form-select' aria-label='Default select example'>
                        <option value="CONTA">CONTA</option>
                        <option>BB</option>
                        <option>BB MEDS</option>
                        <option>BB PROPRIO</option>
                        <option>ITAU</option>
                        <option>BRINKS</option>
                        <option>PROSEGUR</option>
                    </select>
                </div>
                <div class="col-md-2 p-1">
                    <input @keyup="getDepositos('filtrar')" @mouseleave="getDepositos('filtrar')" type='date' class='form-control' name='data1' id='data1'>
                </div>
                <div class="col-md-2 p-1">
                    <input @keyup="getDepositos('filtrar')" @mouseleave="getDepositos('filtrar')" type='date' class='form-control' name='data2' id='data2'>
                </div>
                <div class="col-md-1 p-1 mt-1">
                    <button @click="limparFiltros()" type="button" class='btn btn-danger btn-sm'>Limpar</button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-1 ">
            <thead class="header-tabela">
                <tr>
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
                </tr>
            </thead>
            <tbody>
                <tr v-for="deposito in depositos">
                    <td>{{deposito.dataMovimento}}</td>
                    <td>{{deposito.dataMovimento}}</td>
                    <td>{{deposito.loginName}}</td>
                    <td>{{deposito.dinheiro}}</td>
                    <td>{{deposito.conta}}</td>
                    <td>{{deposito.cheque}}</td>
                    <td>{{deposito.contaCh}}</td>
                    <td>{{deposito.ttdep}}</td>
                    <td>{{deposito.debito}}</td>
                    <td>{{deposito.dataRegistro}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>