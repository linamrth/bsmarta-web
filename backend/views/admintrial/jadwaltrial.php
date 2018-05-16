<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;

use backend\models\Trial;
use backend\models\Jadwal;
use backend\models\Siswa;
use backend\models\Program;
use backend\models\Guru;

$hari = [
            'Senin'=>'Senin', 'Selasa'=>'Selasa', 'Rabu'=>'Rabu', 
            'Kamis'=>'Kamis', 'Jumat'=>'Jumat', 'Sabtu'=>'Sabtu'
        ];

$jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

$trial = Trial::find()->where(['idtrial'=>$trial->idtrial])->one();
$nmsiswa = Siswa::find()->where(['idsiswa'=>$trial->idsiswa])->one();

$trial = Trial::find()->where(['idtrial'=>$trial->idtrial])->one();
$nmprogram = Program::find()->where(['idprogram'=>$trial->idprogram])->one();
?>

<div class="jadwaltrial-view">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
    <h3>
        <?= Html::encode($nmsiswa->namalengkap). ' - '. 
            Html::encode($nmprogram->namaprogram) ?>
    </h3>

    <hr>

    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Form Daftar Jadwal Trial</div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin();?>

                <?= $form->field($model, 'idguru')->dropDownList(
                        $model->listGuru(),
                        ['prompt'=>'-Pilih Nama Guru-']
                    )->label('Guru') ?>

                <?= $form->field($model, 'hari')->dropDownList(
                        $model->getHari(), 
                        ['prompt'=>'-Pilih Hari-']
                    )->label('Pilih Hari') ?>

                <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Input Tanggal Trial'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>

                <?= $form->field($model, 'jam')->dropDownList(
                        $model->getJam(), 
                        ['prompt'=>'-Pilih Jam-']
                    )->label('Pilih Jam') ?>

                <?php echo Html::submitButton('Create Jadwal Trial', ['class'=>'btn btn-success']);?>
            </div>
        </div> 
        <?php ActiveForm::end();?> 
    </div>
</div>

