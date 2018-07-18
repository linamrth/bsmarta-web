<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\Program;
use backend\models\Programlevel;
use backend\models\Siswabelajar;

$this->title = 'Program || Direktur';
?>

<h3>Daftar Program</h3>
<hr>

<table class="table table-striped">
	<thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Program</th>
	        <th>Level</th>
	        <th>Jumlah</th>
	        <th></th>
	    </tr>
	</thead>
	<tbody>
		<?php $n=0; foreach ($programlevel as $key) { $n++; ?>
		<?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$key['idprogramlevel']])->one(); ?>
	    <?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one(); ?>
	    <?php $sisprog   = Siswabelajar::find()->where(['idprogramlevel'=>$key['idprogramlevel'], 'idcabang'=>Yii::$app->user->identity->idcabang])->count(); ?>
			<tr>
				<td><?php echo $n;?></td>
				<td><?php echo Html::encode($nmprogram['namaprogram']);?></td>
				<td><?php echo Html::encode($key->level);?></td>
				<td><?php echo Html::encode($sisprog.' Siswa');?></td>
				<td>
					<?php echo Html::a(
						'<i class="glyphicon glyphicon-search"></i> Lihat Detail',
						['view','id'=>$key['idprogramlevel']],
						['class'=>'btn btn-sm btn-info']);?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>