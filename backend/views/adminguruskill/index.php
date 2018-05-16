<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Guruskill;
use backend\models\Guru;
use backend\models\Programlevel;
use backend\models\Program;

$this->title = 'Skill Guru || Admin';
?>

<div class="row">
	<h3 >Daftar Skill Guru</h3>
	<hr>
	<p>
        <?= Html::a('Create Skill Guru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Guru</th>
				<th>Nama Program</th>
				<th>Level</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($guruskills as $key) { $n++;?>
			<?php $guruskill = Guruskill::find()->where(['idguruskill'=>$key['idguruskill']])->one(); ?>
			<?php $nmguru = Guru::find()->where(['idguru'=>$guruskill['idguru']])->one(); ?>

			<?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$key['idprogramlevel']])->one(); ?>
	    	<?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one(); ?>

				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($nmguru['namaguru']);?></td>
					<td><?php echo Html::encode($nmprogram['namaprogram']);?></td>
					<td><?php echo Html::encode($lvprogram['level']);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-pencil"></i> Update',
							['update','id'=>$key->idguruskill],
							['class'=>'btn btn-primary btn-sm']
							);
						?>

						<?php echo Html::a(
							'<i class="glyphicon glyphicon-remove"></i> Delete',
							['delete','id'=>$key->idguruskill],
							[
				            'class' => 'btn btn-sm btn-danger btn-sm',
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