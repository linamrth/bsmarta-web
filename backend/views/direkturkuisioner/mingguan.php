<?php
/* @var $this yii\web\View */

?>

<div id="direktur-kuisioner">
	<div id="row">
		<h2>Hasil Kuisioner Mingguan</h2>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Guru</th>
					<th>Hasil</th>
				</tr>
			</thead>
			<tbody>
				<?php $n=0; foreach ($hasil as $key) { $n++; ?>
					<tr>
						<td><?= $n;?></td>
						<td><?= $key['idguru'];?></td>
						<td><?= $key['hasil'];?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
