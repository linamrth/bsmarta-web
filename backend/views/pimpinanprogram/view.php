<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Siswa;
use backend\models\Siswabelajar;
use backend\models\Orangtua;
use backend\models\Program;
use backend\models\Programlevel;

$lvprogram = Programlevel::find()->where(['idprogramlevel'=>$judul->idprogramlevel])->one();
$nmprogram = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();

$this->title = $nmprogram->namaprogram. ' - Level '.$lvprogram->level;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?= Html::encode($this->title) ?></h3>

<table class="table table-striped">
	<thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Siswa</th>
	        <th>Kelas</th>
	        <th>Asal Sekolah</th>
	        <th>Orang tua</th>
	    </tr>
	</thead>
	<tbody>
		<?php $n=0; foreach ($model as $key) { $n++; ?>
		<?php $sprogram = Siswabelajar::find()->where(['idsiswabelajar'=>$key['idsiswabelajar']])->one(); ?>
	    <?php $nmsiswa = Siswa::find()->where(['idsiswa'=>$sprogram['idsiswa']])->one(); ?>
	    <?php $nmortu = Orangtua::find()->where(['idorangtua'=>$nmsiswa['idorangtua']])->one(); ?>

			<tr>
				<td><?php echo $n;?></td>
				<td><?php echo Html::encode($nmsiswa['namalengkap']);?></td>
				<td><?php echo Html::encode($nmsiswa['kelas']);?></td>
				<td><?php echo Html::encode($nmsiswa['asalsekolah']);?></td>
				<td><?php echo Html::encode($nmortu['namaortu']);?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>