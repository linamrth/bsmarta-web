<?php
use yii\helpers\Html;

$this->title = 'Update Guru: ' . $model->namaguru;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->namaguru, 'url' => ['view', 'id' => $model->idguru]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Guru-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
