<?php

include 'model.php';

    $model = new Model();

    var_dump($model);

    $rows = $model->findAllMeds();

    var_dump($rows);

    $data = array('rows' => ($rows));

    echo json_encode($data);