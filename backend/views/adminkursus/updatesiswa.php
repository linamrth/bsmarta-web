<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;

$this->title = 'Update Siswa: ' . $model->namalengkap;
$this->params['breadcrumbs'][] = ['label' => 'Siswa Kursus', 'url' => ['siswakursus']];
$this->params['breadcrumbs'][] = ['label' => $model->namalengkap, 'url' => ['detailsiswa', 'id' => $model->idsiswa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?php echo $form->field($model, 'namalengkap')->textInput(['maxlength' => true])?>
    <?php echo $form->field($model, 'namapanggilan')->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'idcabang')->dropDownList(
            $model->listCabang(),
            ['prompt'=>'-Pilih Cabang-']
        )->label('Cabang') ?>
    <?= $form->field($model, 'idorangtua')->dropDownList(
            $model->listOrangtua(),
            ['prompt'=>'-Pilih Orangtua-']
        )->label('Orangtua') ?>
    <?php echo $form->field($model, 'alamat')->textArea(['maxlength' => true])?>
    <?php echo $form->field($model, 'tempatlahir')->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'tgllahir')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Input Tanggal Lahir'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
    <?php echo $form->field($model, 'asalsekolah')->textInput(['maxlength' => true])?>
    <?php echo $form->field($model, 'kelas')->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'tgldaftar')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Input Tanggal Lahir'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
    <?php echo $form->field($model, 'keterangan')->textArea(['maxlength' => true])?>
    <?= $form->field($model, 'foto')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update Siswa', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
