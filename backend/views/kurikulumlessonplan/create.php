<?php

use yii\helpers\Html;

$this->title = 'Create Lesson Plan';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Lesson Plan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
