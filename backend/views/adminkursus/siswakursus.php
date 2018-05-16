<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Program;

$this->title = 'Siswa Kursus || Admin';
?>

<div class="row">
	<h3>Siswa Kursus</h3>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Program Kursus</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($result as $key) { $n++;?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key['namalengkap']);?></td>
					<td><?php echo Html::encode($key['kelas']);?></td>
					<td><?php echo Html::encode($key['namaprogram'].' - Level '.$key['level']);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-user"></i> Detail Siswa',
							['detailsiswa','id'=>$key['idsiswabelajar']],
							['class'=>'btn btn-sm btn-info']
							);
						?>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-check"></i> Informasi Kursus',
							['informasikursus','id'=>$key['idsiswabelajar']],
							['class'=>'btn btn-sm btn-success']
							);
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>