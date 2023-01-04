<?php
include('model/Serasa.php');
include('controller/serasa.php');
?>
<head>
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
/>
<link rel="stylesheet" type="text/css" href="../assets/css/mdb.min.css" rel="stylesheet">
<script src="../assets/js/mdb.min.js"></script>
</head>
<form method="POST">
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
            <select class='form-select' aria-label='Default select example' name="status" id="status">
                <option value="1"><div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Default checkbox
  </label>
</div></option>

            </select>
            </td>
            <td class="center">
                <select name="matriz">
                    <option>Todos</option>
                    <option>Matriz</option>
                    <option>Meds</option>
                </select>
            </td>   
        </tr>
        <tr>
            <td>
                <select name="med">
                    <option value="0">MED</option>
                </select>
            </td>
            <td>
                <select name="tipo">
                    <option>TIPO</option>
                    <option>NOTA</option>
                    <option>CHEQUE</option>
                </select>
            </td>
            <td><input type="text" name="nomeCliente" placeholder="NOME DO CLIENTE"></td>
            <td><input type="text" name="cnpj" placeholder="CPF/CNPJ Cliente"></td>
            <td><input type="text" name="valor" placeholder="VALOR" ></td>
            <td><button type="submit" name="acao" value="limpar">LIMPAR</button></td>
            <td><button type="submit" name="acao" value="filtrar">FILTRAR</button></td>
            <td><input type="button" name="solicitarPefin" VALUE="SOLICITAR PEFIN"></td>
            <td><input type="button" name="solicitarPefin" VALUE="SOLICITAR PEFIN"></td>
        </tr>
        </tbody>
    </table>
</form>
<!-- EXIBINDO A CONSULTA -->
<table class="sortable ">
    <tr>
        <th title="Clique para ordenar!">MED</th>
        <th title="Clique para ordenar!">Tipo do Documento</th>
        <th title="Clique para ordenar!">Nome do Cliente</th>
        <th title="Clique para ordenar!">Valor</th>
        <th title="Clique para ordenar!">Data de Emissão</i></th>
        <th title="Clique para ordenar!">Data de Vencimento</i></th>
        <th title="Clique para ordenar!">Serasa Matriz</i></th>
    </tr>
    <tr>

    </tr>
</table>

