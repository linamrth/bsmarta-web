<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use backend\models\Jadwal;
use backend\models\Trial;
use backend\models\Siswa;


$jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Siswa Trial', 'url' => ['siswatrial']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasitrial-view">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
    <?php foreach ($result as $key) { ?>
    
    <div class="col-sm-6">
        
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Siswa</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($key['namalengkap']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($key['kelas']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Sekolah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($key['asalsekolah']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Program Trial</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['namaprogram']);?>" disabled>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="col-sm-6">
        
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Jadwal</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Guru</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['namaguru']);?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Hari</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['hari']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['tanggal']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Jam</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($jam[$key['jam']]);?>" disabled>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <?php } ?>
    <?php ActiveForm::end();?>
</div>
