<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use backend\controllers\AdmintrialController;

use backend\models\Program;
use backend\models\Jadwal;
use backend\models\Trial;
use backend\models\RapottrialcintabacaForm;
use backend\models\RapottrialcintamatikaForm;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Data Siswa Trial', 'url' => ['indexrapottrial']];
$this->params['breadcrumbs'][] = $this->title;

$tabelcbForm = new RapottrialcintabacaForm(); 	
$CintabacaForm = $tabelcbForm->attributeLabels();

$tabelcmForm = new RapottrialcintamatikaForm();	
$CintamatikaForm = $tabelcmForm->attributeLabels();
?>

<div class="row">
	<h2>Rapot Trial - Cinta Matika</h2>
	<?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Informasi Siswa</div>
				<div class="panel-body">
					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Nama</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['namalengkap']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Kelas</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['kelas']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Program</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['namaprogram']);?>" disabled>
	                    </div>
                	</div>

                	<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Guru</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo Html::encode($result[0]['namaguru']);?>" disabled>
	                    </div>
                	</div>

					<div class="form-group">
	                    <label class="control-label col-sm-4" for="name">Tanggal Input</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" disabled>
	                    </div>
                	</div>
				</div>
			</div>
		<?php ActiveForm::end();?>
	</div>

	<form>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">Informasi Hasil Trial Siswa</div>
			<div class="panel-body">
			<?php $form = ActiveForm::begin();?>
			<?php if($result[0]['idprogram'] == '1'){ ?>
                
            <div class="col-sm-6">

                <div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal1']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal1'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal2']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal2'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal3']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal3'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal4']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal4'];?>" id="email" placeholder="Enter email" disabled>
				</div>
				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal5']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal5'];?>" id="email" placeholder="Enter email" disabled>
				</div>
				
				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal6']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal6'];?>" id="email" placeholder="Enter email" disabled>
				</div>

			</div>

			<div class="col-sm-6">

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal7']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal7'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal8']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal8'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal9']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal9'];?>" id="email"  disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal10']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal10'];?>" id="email"  disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['soal11']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal11'];?>" id="email"  disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintabacaForm['catatan']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['catatan'];?>" id="email" disabled>
				</div>
			</div>
                
            <?php }elseif($result[0]['idprogram'] == '2'){ ?>
            <div class="col-sm-6">

                <div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal1']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal1'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal2']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal2'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal3']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal3'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal4']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal4'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal5']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal5'];?>" id="email" placeholder="Enter email" disabled>
				</div>
				
				</div>
				
				<div class="col-sm-6">

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal6']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal6'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal7']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal7'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['soal8']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['soal8'];?>" id="email" placeholder="Enter email" disabled>
				</div>

				<div class="form-group">
					<label class="control-label" for="email"><?php echo $CintamatikaForm['catatan']; ?></label>
						<input type="text" class="form-control" value="<?php echo $result[0]['catatan'];?>" id="email" disabled>
				</div>
			</div>   
                
            <?php  } ?>               
			<?php ActiveForm::end();?>
			</div>
		</div>	
	</div>
	</form>
</div>
