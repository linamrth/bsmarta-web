<?php
use yii\helpers\Html;

$this->title = 'Update Skill Guru: ' . $model->idguruskill;
$this->params['breadcrumbs'][] = ['label' => 'Skill Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idguruskill, 'url' => ['view', 'id' => $model->idguruskill]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Guruskill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
