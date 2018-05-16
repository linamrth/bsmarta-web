<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use backend\models\RapotbelajarForm;
use backend\models\Rapotbelajar;

$this->title = 'Form Perkembangan Hasil Belajar Siswa || Guru';

?>

<div class="row">
	<h3>Form Perkembangan Hasil Belajar Siswa </h3>
	<hr>

	<?php $form = ActiveForm::begin();?>
		<?php echo $form->field($model, 'idguru')->dropDownList(
			$model->dataGuru(),
			['options'=>[$model->idguru => [
				'selected'=>true]]
			]
		)?>
		<?php echo $form->field($model, 'materi');?>
		<?php echo $form->field($model, 'halamanketercapaian')->textInput();?>
		<?php echo $form->field($model, 'hasil')->textArea();?>
		<?php echo $form->field($model, 'catatanguru')->textArea();?>
		<?php echo $form->field($model, 'rewardhasil')->radioList(array('1'=>'Satu','2'=>'Dua','3'=>'Tiga'));?>
		<?php echo $form->field($model, 'rewardsikap')->radioList(array('1'=>'Satu','2'=>'Dua','3'=>'Tiga'));?>
		<?php echo Html::submitButton('Input Rapot Kursus', ['class'=>'btn btn-success']);?>
		<?php echo Html::a('Kembali', ['allsiswaview','id'=>$back], ['class'=>'btn btn-info']);?>

	<?php ActiveForm::end();?>
</div>