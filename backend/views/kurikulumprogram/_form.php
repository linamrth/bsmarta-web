<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="program-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'namaprogram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'fasilitas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biayadaftar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biayakursus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biayatambahan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i> Tambah Program' : '<i class="glyphicon glyphicon-edit"></i> Edit Program', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
