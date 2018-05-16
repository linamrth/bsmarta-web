<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Daftar Program Trial';
?>
<h1>Daftar Program Trial</h1>
<hr>

<?php $form = ActiveForm::begin();?>
	<?= $form->field($model, 'idsiswa')->dropDownList(
            $model->listSiswa(),
            ['prompt'=>'-Pilih Nama Siswa-'],
            ['options' =>
                [
                    $model->idsiswa => ['selected' => true]
                ]
            ]
        )->label('Siswa') ?>
    <?= $form->field($model, 'idprogram')->dropDownList(
            $model->listProgram(),
            ['prompt'=>'-Pilih Program-']
        )->label('Program') ?>

	<?php echo Html::submitButton('Buat Jadwal Trial', ['class'=>'btn btn-success']);?>
<?php ActiveForm::end();?>