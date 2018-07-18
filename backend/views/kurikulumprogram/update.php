<?php
use yii\helpers\Html;

$this->title = 'Edit Program: ' . $model->namaprogram;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->namaprogram, 'url' => ['view', 'id' => $model->idprogram]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="program-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
