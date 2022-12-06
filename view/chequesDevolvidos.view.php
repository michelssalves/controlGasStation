<?php
include('model/chequesDevolvidos.model.php');
?>
<div class='row'>
    <div class='col-md-12'>
        <div class='d-grid gap-2 d-md-flex mt-4 justify-content-md-end'>
            <button class='btn btn-warning btn-sm'>Incluir</button>
            <form method='POST' id='formulario-cheques'>
                <input type='hidden' name='p' value='2'>
                <input type='hidden' id='action' name='action' value='filtrar-cheques-devolvidos'>
                <button name='filtrar-cheques' class='btn btn-info btn-sm'>Filtrar</button>
                <button class='btn btn-danger btn-sm' onclick='limparFormulario()'>Limpar</button>
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
                            <select id='filial' name='filial' class='form-select' aria-label='Default select example'>
                                <option selected disabled value=''>Filial</option>
                                <?= $cbFilialI ?>
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
        <hr class='border-dark'>

        <div id='tabela'>
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
                    <tbody>
                        <?= $txtTab ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>