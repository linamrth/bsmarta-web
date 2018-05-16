<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use backend\models\KuisionerForm;
use backend\models\Kuisioner;

?>

<div class="row">
	<h4>Data Kuisioner</h4>
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
	</div>

	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">Informasi Kuisioner</div>
				<div class="panel-body">
					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Penguasaan Materi</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['penguasaanmateri']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Kemampuan Mengajar</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['kemampuanmengajar']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Kedisiplinan</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['kedisiplinan']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Tanggung Jawab dan Tingkah Laku</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['tanggungjawabdantingkahlaku']);?>" disabled>
	                    </div>
                	</div>

					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Kerjasama</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['kerjasama']);?>" disabled>
	                    </div>
                	</div>
                	<?php ActiveForm::end();?>
				</div>
			</div>
	</div>
</div>