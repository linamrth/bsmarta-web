<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\UserForm;
use backend\models\User;
use backend\models\Cabang;

$this->title = 'User || Admin';
?>

<div class="row">
	<h3 >Daftar User</h3>
	<hr>
	<p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Level</th>
				<th>Cabang</th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($users as $key) { $n++;?>
			<?php $user = User::find()->where(['id'=>$key['id']])->one(); ?>
	   		<?php $nmcabang = Cabang::find()->where(['idcabang'=>$user['idcabang']])->one(); ?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key->username);?></td>
					<td><?php echo Html::encode($key->getLevel());?></td>
					<td><?php echo Html::encode($nmcabang['namacabang']);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Detail',
							['view','id'=>$key->id],
							['class'=>'btn btn-sm btn-info']
							);
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>