<?php
use yii\helpers\Html;

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Daftar User', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="User-update">

    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
