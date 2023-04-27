<?php 
include './model/chaves/ChaveSimples.php';
include './model/AnaliseVendasCliente.php';
include './controller/analiseVendasCliente.php'; ?>
<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroCreditoIpirangaCorrigeCusto'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select name="gerencia" id="gerencia" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="">GERENCIAREDE</option>
                            <option value="4">GERENCIAREDE04</option>
                            <option value="6">GERENCIAREDE06</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="mes" id="mes" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="">MES</option>
                           <!-- <option v-for="(mes, i) in 12" :value="i+1">{{i+1}}</option>-->
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="ano" id="ano" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option>ANO</option>
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                            <option>2020</option>
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                    </div>
                    <div class="col-md-2 p-1">
                        <select name="formaPgto" id="formaPgto" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option>FORMA PGTO</option>
                            <option>VISTA</option>
                            <option>PRAZO</option>
                            <option>DEPOSITO</option>
                            <option>DINHEIRO</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class='btn btn-light btn-sm' @click="getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')"><img class="iconeSize" :src="iconSearch"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="abrirModal('dadosFrete')"><img class="iconeSize" :src="iconTruck"></button>
                        <button type="button" class='btn btn-light btn-sm' @click="abrirModal('criarFrete')"><img class="iconeSize" :src="iconCreate"></button>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table table-sm table-hover w3-striped mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th>FILIAL</th>
                            <th>APROVADOS</th>
                            <th>COMPRANDO</th>
                            <th>APROVADOS/COMPRANDO (%)</th>
                            <th>VOLUME (L)</th>
                            <th>MEDIA (4 MESES)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $txtTabela ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
<!--/AREA ONDE ESTÁ A TABELA E FILTROS-->