<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use backend\models\KuisionerForm;
use backend\models\Kuisioner;

$this->title = 'Form Kuisioner || Orangtua';

?>

<div class="row">
	<h4>Form Kuisioner</h4>
	<hr>

	<?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Informasi Guru</div>
				<div class="panel-body">
					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Nama Guru</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['namaguru']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Nama Siswa</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['namalengkap']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Program</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['namaprogram']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Level</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['level']);?>" disabled>
	                    </div>
                	</div>

					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Tanggal Input</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" disabled>
	                    </div>
                	</div>
				</div>
			</div>
		<?php ActiveForm::end();?>
	</div>
	
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">Penilaian Kinerja Guru</div>
				<div class="panel-body">
				<?php $form = ActiveForm::begin();?>	
				<div class="col-sm-12">
					<?= $form->field($model, 'penguasaanmateri')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
					<?= $form->field($model, 'kemampuanmengajar')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
					<?= $form->field($model, 'kedisiplinan')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
					<?= $form->field($model, 'tanggungjawabdantingkahlaku')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
					<?= $form->field($model, 'kerjasama')->radioList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
				</div>
				<?php echo Html::submitButton('Submit Kuisioner', ['class' => 'btn btn-success']); ?>
				
				<?php ActiveForm::end();?>
			</div>
		</div>
	</div>
</div>