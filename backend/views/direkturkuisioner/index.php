<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;


$this->title = 'Penilaian Kinerja Guru || Direktur';
function statusLabel($isi)
{
	if($isi < 3.34) {
		$hasil = "<span class='label label-warning'>Warning</span>";
	}
	else{
		$hasil = "<span class='label label-success'>Aman</span>";
	}

	return $hasil;
}
?>

<div class="row">
	<h3>Penilaian Kinerja Guru</h3>
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
			<div class="panel-heading">Informasi Penilaian Kinerja Guru</div>
			<div class="panel-body">
				<table class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Guru</th>
						<th>Total Nilai</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count ($hasil) == 0) {
						echo "<tr><td class='text-center' colspan='4'>".$pesan."</td></tr>";
					} else{ ?>
					<?php $n=0; foreach ($hasil as $key) { $n++; ?>
					<tr>
						<td><?= $n;?></td>
						<td><?= $key['nmguru'];?></td>
						<td><?= ceil($key['hasil']);?></td>
						<td><?= statusLabel($key['hasil']);?></td>
					</tr>
				<?php }} ?>
				</tbody>
				<tbody>
					
				</tbody>
			</table>
			</div>
		</div>	
	</div>
	</form>
</div>
