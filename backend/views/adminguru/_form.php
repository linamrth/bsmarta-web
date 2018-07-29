<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="Guru-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'namaguru')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Nama Guru"]) ?>

    <?= $form->field($model, 'idcabang')->dropDownList(
            $model->listCabang(),
            ['prompt'=>'-Pilih Cabang-']
        )->label('Cabang') ?>

    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input No Telepon"]) ?>

    <?= $form->field($model, 'alamat')->textArea(['maxlength' => true])->textArea(['placeholder' => "Input Alamat"]) ?>

    <?= $form->field($model, 'foto')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i> Tambah Guru' : '<i class="glyphicon glyphicon-edit"></i> Edit Guru', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
