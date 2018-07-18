<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="cabang-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'namacabang')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Nama Cabang"]) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Jenis Cabang"]) ?>

    <?= $form->field($model, 'alamat')->textArea(['maxlength' => true])->textArea(['placeholder' => "Input Alamat Cabang"]) ?>

    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input No Telepon"]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Faximilie"]) ?>

    <?= $form->field($model, 'kabupaten')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Kabupaten"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i> Tambah Cabang' : '<i class="glyphicon glyphicon-edit"></i> Edit Cabang', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
