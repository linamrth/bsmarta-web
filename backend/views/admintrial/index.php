<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\controllers\AdmintrialController;

$this->title = 'Orang Tua || Admin';
?>

<div class="row">
	<h3 >Daftar Orang Tua</h3>
	<hr>
	<p>
        <?= Html::a('Create Data Orang Tua', ['daftarortu'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Telepon</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($ortus as $key) { $n++;?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key->namaortu);?></td>
					<td><?php echo AdmintrialController::listJeniskelamin($key->jeniskelamin);?></td>
					<td><?php echo Html::encode($key->telepon);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Detail',
							['view','id'=>$key->idorangtua],
							['class'=>'btn btn-sm btn-info']
							);
						?>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-plus"></i> Daftar User',
							['formuserortu','id'=>$key->idorangtua],
							['class'=>'btn btn-sm btn-success']
							);
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>