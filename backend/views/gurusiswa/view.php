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
$this->params['breadcrumbs'][] = ['label' => 'Daftar Siswa', 'url' => ['index']];
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
		</tr>
	</thead>
	<tbody>
		<?php $n=0; foreach ($jadwalgenerate as $key) { $n++; ?>
		<?php $itung = Rapotbelajar::find()->where(['idgenerate'=>$key->idgenerate])->count(); ?>
			<tr>
				<td><?php echo Html::encode($n);?></td>
				<td><?php echo Html::encode(GurusiswaController::tglIndo($key->tanggal, true));?></td>
				<td><?php echo Html::encode($key->getNamaGuru());?></td>
				<td>
					<?php if($key->statusrapotkursus === 'B') { ?> 
						<?php if($key->idguru == Yii::$app->user->identity->idguru){ ?>
							<?php echo Html::a(
								'<i class="glyphicon glyphicon-plus"></i> Input Nilai',
								['inputrapot', 'id'=>$key->idgenerate."_".$n], 
								['class'=>'btn btn-sm btn-success']);?>
						<?php } ?>
					<?php } else { ?>
						<?php echo Html::a(
							'<i class="glyphicon glyphicon-search"></i> Lihat Rapot Belajar',
							['lihatrapot', 'id'=>$key->idgenerate], 
							['class'=>'btn btn-sm btn-info']);?>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>