<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Materi;
use backend\models\Programlevel;
use backend\models\Program;

$this->title = 'Materi || Kurikulum';
?>

<div class="row">
	<h3 >Daftar Materi</h3>
	<hr>
	<p>
        <?= Html::a('Create Materi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Program</th>
				<th>Level</th>
				<th>Halaman</th>
				<th>Materi</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($materis as $key) { $n++;?>
			<?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$key['idprogramlevel']])->one(); ?>
	    	<?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one(); ?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($nmprogram['namaprogram']);?></td>
					<td><?php echo Html::encode($lvprogram['level']);?></td>
					<td><?php echo Html::encode($key->hal);?></td>
					<td><?php echo Html::encode($key->materi);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-pencil"></i> Update',
							['update','id'=>$key->idmateri],
							['class'=>'btn btn-primary']
							);
						?>

						<?php echo Html::a(
							'<i class="glyphicon glyphicon-remove"></i> Delete',
							['delete','id'=>$key->idmateri],
							[
				            'class' => 'btn btn-sm btn-danger',
				            'data' => [
				                'confirm' => 'Are you sure you want to delete this item?',
				                'method' => 'post',
			                ]
			            ]);?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>