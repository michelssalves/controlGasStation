<?php
include './model/chaves/ChaveSimples.php';
include './model/VolumeMensalProjetado.php';
include './controller/volumeMensalProjetado.php';
?>
<!--AREA ONDE ESTÁ A TABELA E FILTROS-->
    <div class="tableArea">
        <form method='POST' id='formFiltroVolumeMensalProjetado'>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 p-1">
                        <select name="gerencia" id="gerencia" @change="getVolumeMensalProjetado('formFiltroVolumeMensalProjetado')" class='form-select' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="0">GERENCIADEREDE</option>
                            <option value="4">GERENCIAREDE04</option>
                            <option value="6">GERENCIAREDE06</option>
                        </select>
                        <select name="periodo" id="periodo" style="width:120px"  onchange="this.form.submit()">					
            	            <option selected><?= $periodo; ?></option>
				            <?= $cbPeriodo; ?>
			            </select>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table table-sm table-hover w3-striped mt-1 ">
                    <thead class="header-tabela">
                        <tr>
                            <th colpan="2">&nbsp;</th>
                            <th colspan="<?= $cols; ?>" title="Total de Produtos por Filial"><center>TOTAL</th>
                            <th colspan="<?= $cols; ?>" title="Gasolina Comum"><center>GC</th>
                            <th colspan="<?= $cols; ?>" title="Gasolina Aditivada"><center>GA</th>
                            <th colspan="<?= $cols; ?>" title="Etanol"><center>ET</th>
                            <th colspan="<?= $cols; ?>" title="Diesel S500"><center>S5</th>
                            <th colspan="<?= $cols; ?>" title="Diesel S10"><center>S1</th>
                            <?php if ($mostraGNV == 'checked') { ?>
                            <th colspan="<?= $cols; ?>" title="Gas Natural Veicular"><center>GN</th>
                            <?php } ?>
	                    </tr>
                    	<tr>
		                    <th width="50">Filial</th>
                            <th title="Mês Atual/Ano Anterior"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual >> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb7; ?>
                            <th title="Mês Atual/Ano Anterior"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual >> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb1; ?>
                            <th title="Mês Atual/Ano Anterior"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual >> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb2; ?>
                            <th title="Mês Atual/Ano Anterior" style="border-left:double;"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb3; ?>
                            <th title="Mês Atual/Ano Anterior"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual >> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb4; ?>
                            <th title="Mês Atual/Ano Anterior"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual >> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb5; ?>
                            <?php if ($mostraGNV == 'checked') { ?>
                            <th title="Mês Atual/Ano Anterior"><?= $mmm[$mesP3].'/'.substr($anoP3,2,2); ?></th>
                            <th title="Mês Anterior/Ano Atual"><?= $mmm[$mesP2].'/'.substr($anoP2,2,2); ?></th>
                            <th title="Mês Atual >> <?= date('d',strtotime($data_atu)); ?> dias"><?= $mmm[$mesP1].'/'.substr($anoP1,2,2); ?></th>
                            <?= $cb6; ?>
                            <?php } ?>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr style="cursor:pointer">
                            <?= $txtTabela ?>
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!--/AREA ONDE ESTÁ A TABELA E FILTROS-->
