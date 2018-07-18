<?php
use yii\helpers\Html;

$this->title = 'Edit Target Belajar';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Target Belajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlessonplan, 'url' => ['view', 'id' => $model->idlessonplan]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="lessonplan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
