<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Orang Tua: ' . $model->namaortu;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Orang Tua', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->namaortu, 'url' => ['view', 'id' => $model->idorangtua]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php $form = ActiveForm::begin();?>
	<?php echo $form->field($model, 'namaortu')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Nama Orang Tua"])?>
	<?= $form->field($model, 'jeniskelamin')->dropDownList(
            $model->listJeniskelamin(),
            ['prompt'=>'-Pilih Jenis Kelamin-']
        )->label('Jenis Kelamin') ?>
	<?php echo $form->field($model, 'telepon')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input No Telepon"])?>

	<?php echo Html::submitButton('<i class="glyphicon glyphicon-edit"></i> Edit Data Orangtua', ['class'=>'btn btn-primary']);?>
<?php ActiveForm::end();?>