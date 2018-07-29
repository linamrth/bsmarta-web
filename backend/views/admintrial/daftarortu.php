<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Create Orang Tua';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Orang Tua', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin();?>
	<?php echo $form->field($model, 'namaortu')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input Nama Orang Tua"])?>
	<?= $form->field($model, 'jeniskelamin')->dropDownList(
            $model->listJeniskelamin(),
            ['prompt'=>'-Pilih Jenis Kelamin-']
        )->label('Jenis Kelamin') ?>
	<?php echo $form->field($model, 'telepon')->textInput(['maxlength' => true])->textInput(['placeholder' => "Input No Telepon"])?>
	<?= $form->field($model, 'foto')->fileInput() ?>

	<?php echo Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Tambah Data Orangtua', ['class'=>'btn btn-success']);?>
<?php ActiveForm::end();?>