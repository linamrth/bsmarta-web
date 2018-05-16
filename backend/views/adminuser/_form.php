<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="User-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Username"]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Email"]) ?>
    
    <?= $form->field($model, 'password')->passwordInput()->label('Password Hint') ?>

    <?= $form->field($model, 'idcabang')->dropDownList(
            $model->listCabang(),
            ['prompt'=>'-Pilih Cabang-']
        )->label('Cabang') ?>

    <?= $form->field($model, 'level')->dropDownList(
            $model->listLevel(),
            ['prompt'=>'-Pilih Level-']
        )->label('Nama Level') ?>

    <?= $form->field($model, 'idguru')->dropDownList(
            $model->listGuru(),
            ['prompt'=>'-Pilih Guru-']
        )->label('Guru') ?>

    <div class="form-group">
        <?= Html::submitButton('Create User', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
