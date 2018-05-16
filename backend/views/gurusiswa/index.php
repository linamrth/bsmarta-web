<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Jadwal;
use backend\models\Siswa;
use backend\models\Siswabelajar;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Guru;

$this->title = 'Siswa Pribadi || Guru';
?>

<div class="row">
	<h3>Daftar Siswa</h3>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Program</th>
				<th>Level</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($siswabelajar as $key) { $n++;?>

			<?php $sprogram = Siswabelajar::find()->where(['idsiswabelajar'=>$key['idsiswabelajar']])->one(); ?>
		    <?php $nmsiswa = Siswa::find()->where(['idsiswa'=>$sprogram['idsiswa']])->one(); ?>

		    <?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$key['idprogramlevel']])->one(); ?>
		    <?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one(); ?>

				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($nmsiswa['namalengkap']);?></td>
					<td><?php echo Html::encode($nmsiswa['kelas']);?></td>
					<td><?php echo Html::encode($nmprogram['namaprogram']);?></td>
					<td><?php echo Html::encode($lvprogram['level']);?></td>
					<td>
					<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Detail Perkembangan Hasil Belajar',
							['view','id'=>$key['idsiswabelajar']],
							['class'=>'btn btn-sm btn-info']
							);
						?>
	                
	            	</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>