<?php

use yii\helpers\Html;

$this->title = 'Create Skill Guru';
$this->params['breadcrumbs'][] = ['label' => 'Skill Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guruskill-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
