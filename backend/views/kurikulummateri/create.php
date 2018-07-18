<?php

use yii\helpers\Html;

$this->title = 'Tambah Materi';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Materi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materi-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
