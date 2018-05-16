<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use backend\controllers\GurusiswaController;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Guru;
use backend\models\Rapotbelajar;

use dosamigos\chartjs\ChartJs;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Data Siswa Kursus', 'url' => ['indexrapotkursus']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Hasil Perkembangan Siswa : <?php echo $result[0]['namalengkap'].' - '.$result[0]['namaprogram'].' '.$result[0]['level'];?></h3>
<hr>
<p>
	<?= Html::a('Grafik Perkembangan Hasil Belajar',['grafikperkembangan', 'id'=>$result[0]['idsiswabelajar']],['class'=>'btn btn-info'])?>
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Pertemuan</th>
			<th>Tanggal</th>
			<th>Guru</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $n=0; foreach ($jadwalgenerate as $key) { $n++; ?>
		<?php $itung = Rapotbelajar::find()->where(['idgenerate'=>$key->idgenerate])->count(); ?>
			<tr>
				<td><?php echo Html::encode($n);?></td>
				<td><?php echo Html::encode(GurusiswaController::tglIndo($key->tanggal, true));?></td>
				<td><?php echo Html::encode($key->getNamaGuru());?></td>
				<td><?php echo $itung == 0 ? '<span class="label label-warning">Belum Terisi</span>':'<span class="label label-success">Sudah Terisi</span>'; ?></td>
				<td>
					<?php if($itung == 0) { ?> 
						<span class="label label-danger">Belum Input Rapot</span>
					<?php } else { ?>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Lihat Rapot Kursus',
							['rapotkursus', 'id'=>$key->idgenerate], 
							['class'=>'btn btn-sm btn-info btn-sm']);?>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>