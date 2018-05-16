<?php
use yii\helpers\Html;

$this->title = 'Update Lesson Plan';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lesson Plan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlessonplan, 'url' => ['view', 'id' => $model->idlessonplan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lessonplan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
