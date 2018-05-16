<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Guru;
use backend\models\Cabang;

$this->title = 'Guru || Admin';
?>

<div class="row">
	<h3 >Daftar Guru</h3>
	<hr>
	<p>
        <?= Html::a('Create Guru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Guru</th>
				<th>Nama Cabang</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($gurus as $key) { $n++;?>
			<?php $guru = Guru::find()->where(['idguru'=>$key['idguru']])->one(); ?>
	   		<?php $nmcabang = Cabang::find()->where(['idcabang'=>$guru['idcabang']])->one(); ?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key->namaguru);?></td>
					<td><?php echo Html::encode($nmcabang['namacabang']);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Detail',
							['view','id'=>$key->idguru],
							['class'=>'btn btn-sm btn-info']
							);
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>