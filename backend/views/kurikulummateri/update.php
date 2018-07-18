<?php
use yii\helpers\Html;

$this->title = 'Edit Materi';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Materi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmateri, 'url' => ['view', 'id' => $model->idmateri]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="materi-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
