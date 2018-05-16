<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="materi-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'idprogramlevel')->dropDownList(
    		$model->listProgramlevel(),
			['prompt'=>'-Pilih Program dan Level-']
    	)->label('Program') ?>

    <?= $form->field($model, 'hal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'materi')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
