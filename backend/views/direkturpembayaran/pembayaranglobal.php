<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use backend\controllers\DirekturpembayaranController;

use backend\models\Pembayaran;

$this->title = 'Pembayaran Global || Direktur';
function angkaRupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
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
						<th>Tanggal Pembayaran</th>
						<th>Program Kursus</th>
						<th>Biaya Kursus</th>
					</tr>
				</thead>
				<tbody>
					<?php $countBiaya = 0;?>
					<?php $n=0; foreach ($result as $key) { $n++; $countBiaya += $key['biayakursus'];?>
					<tr>
						<td><?= $n;?></td>
						<td><?= $key['namalengkap'];?></td>
						<td><?php echo Html::encode(DirekturpembayaranController::tglIndo($key['tanggal'], true));?></td>
						<td><?= $key['namaprogram'].'- Level '.$key['level'];?></td>
						<td><?= angkaRupiah($key['biayakursus']);?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<h4 align="right">Total Pendapatan : <?= angkaRupiah($countBiaya);?></h4>
			</div>
		</div>	
	</div>
	</form>
</div>
