<?php

use yii\helpers\Html;

$this->title = 'Create Skill Guru';
$this->params['breadcrumbs'][] = ['label' => 'Skill Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guruskill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
