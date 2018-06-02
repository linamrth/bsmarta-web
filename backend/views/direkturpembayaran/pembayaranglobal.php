<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use backend\controllers\DirekturpembayaranController;

use backend\models\Pembayaran;

$this->title = 'Pembayaran Global || Direktur';
?>

<div class="row">
	<h3>Pembayaran Global</h3>
	<hr>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Pencarian</div>
			<div class="panel-body">
				<?php $form = ActiveForm::begin(['options'=>['class'=>'form-vertical']]);?>
                	<?= $form->field($model, 'tahun')->dropDownList($tahun, ['prompt'=>'-Pilih Tahun-']);?>
                	<?= $form->field($model, 'bulan')->dropDownList($bulan, ['prompt'=>'-Pilih Bulan-']);?>
	                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
				<?php ActiveForm::end();?>
            </div>
		</div>
	</div>

	<form>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">Informasi Pembayaran Global</div>
			<div class="panel-body">
				<table class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Siswa</th>
						<th>Program Kursus</th>
						<th>Tanggal</th>
						<th>Status Pembayaran</th>
					</tr>
				</thead>
				<tbody>
					<?php $n=0; foreach ($result as $key) { $n++; ?>
					<tr>
						<td><?= $n;?></td>
						<td><?= $key['namalengkap'];?></td>
						<td><?= $key['namaprogram'].'- Level '.$key['level'];?></td>
						<td><?php echo Html::encode(DirekturpembayaranController::tglIndo($key['tanggal'], true));?></td>
						<td>
		                    <?php if($key['statuspembayaran'] === 'B') { ?>  
		                        <span class="label label-danger">Belum Bayar</span>
		                    <?php } else { ?>
		                        <span class="label label-success">Sudah Bayar</span>
		                    <?php } ?>
		                </td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			</div>
		</div>	
	</div>
	</form>
</div>
