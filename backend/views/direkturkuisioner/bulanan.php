<?php
/* @var $this yii\web\View */
function statusLabel($isi)
{
	if($isi < 3.34) {
		$hasil = "Warning";
	}
	else{
		$hasil = "Aman";
	}

	return $hasil;
}
?>

<div id="direktur-kuisioner">
	<div id="row">
		<h2>Hasil Kuisioner Bulanan</h2>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Guru</th>
					<th>Hasil</th>
					<th>Label</th>
				</tr>
			</thead>
			<tbody>
				<?php $n=0; foreach ($hasil as $key) { $n++; ?>
					<tr>
						<td><?= $n;?></td>
						<td><?= $key['nmguru'];?></td>
						<td><?= $key['hasil'];?></td>
						<td><?= statusLabel($key['hasil']);?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
