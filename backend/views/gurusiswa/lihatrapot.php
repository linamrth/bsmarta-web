<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Guru;
use backend\models\Siswa;

$this->title = 'Hasil Perkembangan Belajar Siswa || Guru';
?>

<h3>Hasil Perkembangan Belajar Siswa : <?php echo $siswa['namalengkap'].' - '.$program['namaprogram'].' '.$lvprogram['level'];?></h3>
<hr>
<p>
	<?= Html::a('Kembali',['view', 'id'=>$back],['class'=>'btn btn-warning'])?>
</p>
<style type="text/css">
	.glyphicon {
    	font-size: 50px;
	}
</style>
<?php $nmguru = Guru::findOne(['idguru'=>$rapot->idguru]);?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<label>Pertemuan <?php echo $rapot->pertemuanke;?></label>
		<label class="text-center">(<?php echo $nmguru->namaguru;?>)</label>
		<label class="pull-right"><?php echo $rapot->tanggal;?></label>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="usr">Materi Pembelajaran</label>
					<textarea class="form-control" disabled><?php echo Html::encode($rapot->materi);?></textarea>
				</div>
				<div class="form-group">
					<label for="usr">Hasil Belajar</label>
					<textarea class="form-control" disabled><?php echo Html::encode($rapot->hasil);?></textarea>
				</div>
				<div class="form-group">
					<label for="usr">Halaman Ketercapaian </label>
					<input class="form-control" type="text" disabled value="<?php echo Html::encode($rapot->halamanketercapaian);?>" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="usr">Catatan Guru </label>
					<textarea class="form-control" disabled><?php echo Html::encode($rapot->catatanguru);?></textarea>
				</div>
				<div class="form-group">
					<label for="usr">Reward Hasil Belajar</label><br>
					<?php for($i=0; $i<$rapot->rewardhasil; $i++){ ?>
						<span class="glyphicon glyphicon-star-empty"></span>
					<?php } ?>
				</div>
				<div class="form-group">
					<label for="usr">Reward Sikap Belajar</label> <br>
					<?php for($i=0; $i<$rapot->rewardsikap; $i++){ ?>
						<span class="glyphicon glyphicon-star-empty"></span>
					<?php } ?> 
				</div>
			</div>
		</div>
	</div>
</div>