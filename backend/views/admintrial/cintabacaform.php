<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use backend\models\Siswa;
use backend\models\Program;
use backend\models\Guru;

$this->title = $trial->getSiswa();
$this->params['breadcrumbs'][] = ['label' => 'Siswa Trial', 'url' => ['siswatrial']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<h2> Parameter Rapot Trial - Cinta Baca </h2>
	<?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Informasi Siswa</div>
				<div class="panel-body">
					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Nama</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($siswa->namalengkap);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Kelas</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($siswa->kelas);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Program</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($program->namaprogram);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Guru</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($guru->namaguru);?>" disabled>
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
			<div class="panel-heading">Kemampuan Belajar</div>
				<div class="panel-body">
				<?php $form = ActiveForm::begin();?>	
				<div class="col-sm-6">
					<?= $form->field($model, 'soal1')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak']) ?>
					<?= $form->field($model, 'soal2')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak']) ?>
					<?= $form->field($model, 'soal3')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak']) ?>
					<?= $form->field($model, 'soal4')->radioList(['Baik' => 'Baik', 'Cukup' => 'Cukup', 'Kurang' => 'Kurang']) ?>
					<?= $form->field($model, 'soal5')->radioList(['Baik' => 'Baik', 'Cukup' => 'Cukup', 'Kurang' => 'Kurang']) ?>
					<?= $form->field($model, 'soal6')->radioList(['Baik' => 'Baik', 'Cukup' => 'Cukup', 'Kurang' => 'Kurang']) ?>
					<?= $form->field($model, 'soal7')->radioList(['Baik' => 'Baik', 'Cukup' => 'Cukup', 'Kurang' => 'Kurang']) ?>
				</div>
				<div class="col-sm-6">	
					<?= $form->field($model, 'soal8')->radioList(['Baik' => 'Baik', 'Cukup' => 'Cukup', 'Kurang' => 'Kurang']) ?>
					<?= $form->field($model, 'soal9')->radioList(['Baik' => 'Baik', 'Cukup' => 'Cukup', 'Kurang' => 'Kurang']) ?>
					<?= $form->field($model, 'soal10')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak']) ?>
					<?= $form->field($model, 'soal11')->radioList(['Ya' => 'Ya', 'Tidak' => 'Tidak']) ?>
					<?= $form->field($model,'catatan')->textArea();?>
				</div>
				<?php echo Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Tambah Rapot Trial', ['class' => 'btn btn-success']); ?>
				
				<?php ActiveForm::end();?>
			</div>
		</div>
	</div>
</div>
		