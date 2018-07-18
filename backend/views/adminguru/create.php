<?php
use yii\helpers\Html;

$this->title = 'Create Guru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guru-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
