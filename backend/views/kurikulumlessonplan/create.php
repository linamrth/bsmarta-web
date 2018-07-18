<?php

use yii\helpers\Html;

$this->title = 'Tambah Target Belajar';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Target Belajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson plan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
