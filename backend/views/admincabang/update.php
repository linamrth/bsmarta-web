<?php
use yii\helpers\Html;

$this->title = 'Update Cabang: ' . $model->namacabang;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Cabang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->namacabang, 'url' => ['view', 'id' => $model->idcabang]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cabang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
