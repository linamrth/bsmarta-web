<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;

$this->title = 'Jumlah Siswa Per Kelas || Direktur';
?>

<h3>Daftar Kelas</h3>

<table class="table table-striped">
	<thead>
	    <tr>
	        <th>No</th>
	        <th>Kelas</th>
	        <th>Jumlah</th>
	        <th></th>
	    </tr>
	</thead>
	<tbody>
		<?php $n=0; foreach ($kelas as $key) { $n++; ?>
	    <?php $sisprog   = Siswabelajar::find()->where(['kelas'=>$key['kelas'], 'idcabang'=>Yii::$app->user->identity->idcabang])->count(); ?>
			<tr>
				<td><?php echo $n;?></td>
				<td><?php echo Html::encode($kelas['kelas']);?></td>
				<td><?php echo Html::encode($sisprog.' Siswa');?></td>
				<td>
					<?php echo Html::a(
						'<i class="glyphicon glyphicon-search"></i> Lihat Detail',
						['view','id'=>$key['idsiswabelajar']],
						['class'=>'btn btn-sm btn-info']);?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>