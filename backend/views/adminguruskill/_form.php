<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="Guruskill-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'idguru')->dropDownList(
			$model->listGuru(),
			['prompt'=>'-Pilih Nama Guru-']
		)->label('Guru') ?>

    <?= $form->field($model, 'idprogramlevel')->dropDownList(
    		$model->listProgramlevel(),
			['prompt'=>'-Pilih Program dan Level-']
    	)->label('Program') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create Skill Guru' : 'Update Skill Guru', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
