<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Daftar Program Kursus';
?>
<h1>Daftar Program Kursus</h1>

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
    <?= $form->field($model, 'idprogramlevel')->dropDownList(
            $model->listProgramLevel(),
            ['prompt'=>'-Pilih Program-']
        )->label('Program') ?>

	<?php echo Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Daftar Program Kursus', ['class'=>'btn btn-success']);?>
<?php ActiveForm::end();?>