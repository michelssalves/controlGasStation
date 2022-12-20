<?php include('model/chequesDevolvidos.model.php'); ?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto mt-4">  
            <form method='POST' id='formulario-cheques'>
                <input type='hidden' name='p' value='2'>
                <input type='hidden' id='action' name='action' value='filtrar-cheques-devolvidos'>
                <button type="button" class='btn btn-warning btn-sm' onclick="incluirCheque()" >Incluir</button>
                <button name='filtrar-cheques' class='btn btn-info btn-sm'>Filtrar</button>
                <button type="submit" class='btn btn-danger btn-sm'>Limpar</button>
        </div>
    </div>
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
                                <input class='form-check-input' type="checkbox" name="s0" value="checked" <?= $s[0]; ?>>
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Todos
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s1" value="checked" <?= $s[1]; ?>>
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Novo
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s2" value="checked" <?= $s[2]; ?>>
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Negociando
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s3" value="checked" <?= $s[3]; ?>>
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Quitado
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s4" value="checked" <?= $s[4]; ?> >
                                <label class='form-check-label' for='flexCheckChecked'>
                                    PFIN
                                </label>
                            </div>
                        </td>

                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s5" value="checked" <?= $s[5]; ?> >
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Juridico
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s6" value="checked" <?= $s[6]; ?> >
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Execução
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s7" value="checked" <?= $s[7]; ?> >
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Caduco
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s8" value="checked" <?= $s[8]; ?> >
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Extraviado
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type="checkbox" name="s9" value="checked" <?= $s[9]; ?> >
                                <label class='form-check-label' for='flexCheckChecked'>
                                    Cancelado
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <select id='tipoData' name='tipoData' class='form-select' aria-label='Default select example'>
                                <option selected value='0'>Data Inclusão</option>
                                <option value='1'>Data Cheque</option>
                                <option value='2'>Data Devolução</option>
                                <option value='3'>Data Quitação</option>
                            </select>
                        </td>
                        <td colspan='2'>
                            <select id='id_med' name='id_med' class='form-select' aria-label='Default select example'>
                            <option selected value="<?=($id_med ? $id_med : ''); ?>"><?= ($nome_f[$id_med] ? $nome_f[$id_med] : 'Filial'); ?></option>
                            <?= $cboMed ?>
                            </select>
                        </td>
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
                        <td><input class='form-control' type='date' name='data1' id='data1' value='<?=$data1?>'></td>
                        <td><input class='form-control' type='date' name='data2' id='data2' value='<?=$data2?>'></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </form>
        <div class="table-responsive">
        <div class="tabela-ver-todos-os-cheques">
             <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm table-hover table-striped fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
                
             <thead>
                    <tr style='background-color:#009688'>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Id</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Reg</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Banco</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">Cliente</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">Nr Cheque</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Motivo</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Cheque</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">Valor</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Devol</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dias</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">$ Corr</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Dt Quit</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">Med</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">Stat</th>
                        <th data-tablesaw-sortable-col data-tablesaw-priority="5">UltAlt</th>
                    </tr>
                </thead>
                <tbody>
                     <?= $txtTab ?> 
                </tbody>  
            </table>
        </div>    
    </div>
</div>
</div>
