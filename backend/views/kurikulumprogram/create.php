<?php
use yii\helpers\Html;

$this->title = 'Tambah Program';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
