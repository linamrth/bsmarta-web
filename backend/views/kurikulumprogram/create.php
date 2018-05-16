<?php
use yii\helpers\Html;

$this->title = 'Create Program';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
