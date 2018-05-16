<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Orangtua;
use backend\models\Siswa;
use backend\models\Trial;
use backend\models\Program;
use backend\models\Jadwal;
use backend\models\Guru;
use backend\models\Rapottrial;
use backend\models\Siswabelajar;

$this->title = 'Daftar Siswa Kursus || Admin';
?>

<div class="row">
	<h3>Daftar Siswa Kursus</h3>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Nama Orang Tua</th>
				<th>Program Trial</th>
				<th>Guru Trial</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($result as $key) { $n++;?>
				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key['namalengkap']);?></td>
					<td><?php echo Html::encode($key['kelas']);?></td>
					<td><?php echo Html::encode($key['namaortu']);?></td>
					<td><?php echo Html::encode($key['namaprogram']);?></td>
					<td><?php echo Html::encode($key['namaguru']);?></td>
					<td>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-list-alt"></i> Daftar Program Kursus',
							['daftarprogramkursus','id'=>$key['idhasiltrial']],
							['class'=>'btn btn-sm btn-danger']); 
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>