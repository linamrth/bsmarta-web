<?php
use yii\helpers\Html;

$this->title = 'Update Materi';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Materi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmateri, 'url' => ['view', 'id' => $model->idmateri]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="materi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
