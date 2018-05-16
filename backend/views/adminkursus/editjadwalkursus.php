<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Jadwal;
use backend\models\Program;
use backend\models\Guru;
use backend\models\Programlevel;

$this->title = $siswa->namalengkap;
$this->params['breadcrumbs'][] = ['label' => 'Siswa Kursus', 'url' => ['siswakursus']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['informasikursus', 'id'=>$siswabelajar->idsiswabelajar]];
$this->params['breadcrumbs'][] = 'Edit Jadwal Kursus';

$listHari = [
            'Senin'=>'Senin', 'Selasa'=>'Selasa', 'Rabu'=>'Rabu', 
            'Kamis'=>'Kamis', 'Jumat'=>'Jumat', 'Sabtu'=>'Sabtu'
        ];

$listJam = [
            '1'=>'08.00-09.00','2'=>'09.00-10.00','3'=>'10.00-11.00', 
            '4'=>'11.00-12.00', '5'=>'13.00-14.00', '6'=>'14.00-15.00', 
            '7'=>'15.00-16.00', '8'=>'16.00-17.00', '9'=>'18.00-19.00'
        ];


$siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$siswabelajar->idsiswabelajar])->one();
$nmsiswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();

$siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$siswabelajar->idsiswabelajar])->one();
$programlevel = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
$nmprogram = Program::find()->where(['idprogram'=>$programlevel->idprogram])->one();
?>

<div class="buatjadwal-form">
    <h3>
        <?= Html::encode($nmsiswa->namalengkap). ' - '. 
            Html::encode($nmprogram->namaprogram). ' '.
            Html::encode($programlevel->level) ?>
    </h3>

    <div class="col-sm-6">
        <?php $form = ActiveForm::begin();?>

            <?= $form->field($model, 'idguruskill')->dropDownList(
                    $gurunya, 
                    ['prompt'=>'-Pilih Nama Guru-'],
                    ['options'=>[
                            $model->idguruskill=>['selected'=>true]
                        ]
                ])->label('Guru') ?>

            <?= $form->field($model, 'hari[]')->dropDownList(
                    $model->getHari(), 
                    ['prompt'=>'-Pilih Hari Ke 1-'],
                    ['options'=>[
                            $model->hari=>['selected'=>true]
                        ]
                ])->label('Pilih Hari') ?>

            <?= $form->field($model, 'tanggal[]')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'jam[]')->dropDownList(
                    $model->getJam(), 
                    ['prompt'=>'-Pilih Jam-'],
                    ['options'=>[
                            $model->jam=>['selected'=>true]
                        ]
                ])->label('Pilih Jam') ?>

            <?php echo Html::submitButton('Update Jadwal Kursus', ['class'=>'btn btn-primary']);?>
        <?php ActiveForm::end();?>
    </div>
</div>