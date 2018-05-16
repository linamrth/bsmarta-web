<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create User Orang tua';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Orang tua', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<hr>

<?php $form = ActiveForm::begin([
    'options' => [
        'enctype'=>'multipart/form-data'
    ]
]); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Username"]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Email"]) ?>

<?= $form->field($model, 'password')->passwordInput()->label('Password Hint') ?>

<div class="form-group">
    <?= Html::submitButton('Create User Ortu', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
