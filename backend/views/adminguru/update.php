<?php
use yii\helpers\Html;

$this->title = 'Update Guru: ' . $model->namaguru;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->namaguru, 'url' => ['view', 'id' => $model->idguru]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Guru-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
