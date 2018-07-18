<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

$this->title = 'Program || Kurikulum';
?>

<div class="row">
	<h3 >Daftar Program</h3>
	<hr>
	<p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Program</th>
				<th>Deskripsi</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($programs as $key) { $n++;?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key->namaprogram);?></td>
					<td><?php echo Html::encode($key->deskripsi);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Detail Programs',
							['view','id'=>$key->idprogram],
							['class'=>'btn btn-sm btn-info']
							);
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>