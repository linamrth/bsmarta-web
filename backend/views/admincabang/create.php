<?php
use yii\helpers\Html;

$this->title = 'Create Cabang';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Cabang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
