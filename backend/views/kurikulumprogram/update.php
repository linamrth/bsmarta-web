<?php
use yii\helpers\Html;

$this->title = 'Update Program: ' . $model->namaprogram;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->namaprogram, 'url' => ['view', 'id' => $model->idprogram]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
