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

$this->title = 'Siswa Trial || Admin';
?>

<div class="row">
	<h3>Siswa Trial</h3>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Program</th>
				<th>Guru</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $n=0; foreach ($jadwals as $key) { $n++;?>

				<tr>
					<td><?php echo $n;?></td>
					<td><?php echo Html::encode($key['namalengkap']);?></td>
					<td><?php echo Html::encode($key['kelas']);?></td>
					<td><?php echo Html::encode($key['namaprogram']);?></td>
					<td><?php echo Html::encode($key['namaguru']);?></td>
					<td>
					<?php echo Html::a(
							'<i class="glyphicon glyphicon-check"></i> Informasi Trial',
							['informasitrial','id'=>$key['idjadwal']],
							['class'=>'btn btn-sm btn-success']
							);
						?>
	                <?php if($key['status'] === 'Y') { ?>
	                    <?php echo Html::a('<i class="glyphicon glyphicon-search"></i> Lihat Rapot Trial', ['rapottrial', 'id'=>$key['idjadwal']], ['class'=>'btn btn-info btn-sm','margin-left'=>'30px'] ); ?>
	                <?php } elseif($key['status'] === 'K') {
	                            
	                            //cinta baca 
	                            if($key['idprogram'] == '1'){
	                                echo Html::a('<i class="glyphicon glyphicon-plus"></i> Input Rapot Trial', ['cintabacaform', 'id'=>$key['idjadwal']], ['class'=>'btn btn-danger btn-sm'] );

	                            //cinta matika
	                            }elseif($key['idprogram'] == '2'){
	                                echo Html::a('<i class="glyphicon glyphicon-plus"></i> Input Rapot Trial', ['cintamatikaform', 'id'=>$key['idjadwal']], ['class'=>'btn btn-danger btn-sm'] );
	                            }
	                    }?>
	            	</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>