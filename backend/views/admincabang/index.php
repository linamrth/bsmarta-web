<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

$this->title = 'Cabang || Admin';
?>

<div class="row">
	<h3 >Daftar Cabang</h3>
	<hr>
	<p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Cabang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Cabang</th>
				<th>Jenis</th>
				<th>Kabupaten</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($cabangs as $key) { $n++;?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key->namacabang);?></td>
					<td><?php echo Html::encode($key->jenis);?></td>
					<td><?php echo Html::encode($key->kabupaten);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Detail Cabang',
							['view','id'=>$key->idcabang],
							['class'=>'btn btn-sm btn-info']
							);
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>