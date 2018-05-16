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
use backend\models\Kuisioner;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Data Siswa Kursus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?php echo $result[0]['namalengkap'].' - '.$result[0]['namaprogram'].' '.$result[0]['level'];?></h3>
<hr>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Minggu Ke</th>
			<th>Tanggal</th>
			<th>Guru</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $n=0; foreach ($result as $key) { $n++; ?>
			<tr>
				<td><?php echo Html::encode($n);?></td>
				<td><?php echo Html::encode($key['tanggal']);?></td>
				<td><?php echo Html::encode($key['namaguru']);?></td>
				<td>
					<?php if($key['statuskuisioner'] === 'S') { ?> 
                    	<span class="label label-info">Sudah Isi Kuisioner</span>  
                    	
                    <?php }else{?>
                        <span class="label label-danger">Belum Isi Kuisioner</span>
                        
                    <?php } ?>
                </td>
                <td>
                	<?php if($key['tanggal'] <= date('Y-m-d')){ ?>
                		<?php if($key['statuskuisioner'] === 'S') { ?> 
                			<?php echo Html::a('Lihat Kuisioner', ['lihatkuisioner', 'id'=>$key['idkuisioner']], ['class'=>'btn btn-success','margin-left'=>'30px'] ); ?>
                		<?php }else{?>
                			<?php echo Html::a('Isi Kuisioner', ['inputkuisioner', 'id'=>$key['idkuisioner']], ['class'=>'btn btn-warning','margin-left'=>'30px'] ); ?>
                		<?php } ?>
                	<?php } ?>
                </td>
			</tr>
		<?php } ?>
	</tbody>
</table>

