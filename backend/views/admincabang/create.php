<?php
use yii\helpers\Html;

$this->title = 'Tambah Cabang';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Cabang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabang-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
