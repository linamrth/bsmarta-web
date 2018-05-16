<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;

$this->title = 'Update Siswa Belajar: ' . $model->getsiswa();
$this->params['breadcrumbs'][] = ['label' => 'Siswa Kursus', 'url' => ['siswakursus']];
$this->params['breadcrumbs'][] = ['label' => $model->getsiswa(), 'url' => ['detailsiswa', 'id' => $model->idsiswabelajar]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Siswabelajar-update">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?php echo Html::submitButton('Update Siswa Belajar', ['class'=>'btn btn-primary']);?>
<?php ActiveForm::end();?>

</div>
