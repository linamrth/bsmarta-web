<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;

$this->title = 'Daftar Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Orang Tua', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'View', 'url' => ['view', 'id' => $model->idorangtua]];
$this->params['breadcrumbs'][] = 'Daftar Siswa';
?>
<h1>Daftar Siswa</h1>
<hr>

<?php $form = ActiveForm::begin();?>
	<?= $form->field($model, 'idcabang')->dropDownList(
            $model->listCabang(),
            ['prompt'=>'-Pilih Cabang-']
        )->label('Cabang') ?>
    <?= $form->field($model, 'idorangtua')->dropDownList(
            $model->listOrangtua(),
            ['prompt'=>'-Pilih Orang Tua-'],
            ['options' =>
                [
                    $model->idorangtua => ['selected' => true]
                ]
            ]
        )->label('Orang Tua') ?>
	<?php echo $form->field($model, 'namalengkap')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Nama Lengkap"])?>
	<?php echo $form->field($model, 'namapanggilan')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Nama Panggilan"])?>
	<?php echo $form->field($model, 'alamat')->textArea(['maxlength' => true])->textArea(['placeholder' => "Input Alamat"])?>
	<?php echo $form->field($model, 'tempatlahir')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Tempat Lahir"])?>
	<?= $form->field($model, 'tgllahir')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Input Tanggal Lahir'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
	<?php echo $form->field($model, 'asalsekolah')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Asal Sekolah"])?>
	<?php echo $form->field($model, 'kelas')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Kelas"])?>
	<?php echo $form->field($model, 'keterangan')->textArea(['maxlength' => true])->textArea(['placeholder' => "Input Keterangan"])?>

	<?php echo Html::submitButton('Create Siswa', ['class'=>'btn btn-success']);?>
<?php ActiveForm::end();?>