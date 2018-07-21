<?php

use yii\helpers\Html;

$this->title = 'Create Kemampuan Mengajar Guru';
$this->params['breadcrumbs'][] = ['label' => 'Skill Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guruskill-create">

    <?= $this->render('_formguruskill', [
        'model' => $model,
    ]) ?>

</div>
