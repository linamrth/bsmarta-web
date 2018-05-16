<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Siswa Kursus', 'url' => ['siswakursus']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="informasitrial-view">
<h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
    <?php foreach ($result as $key) { ?>
    
    <p>
        <?= Html::a('Update', ['updatesiswa', 'id' => $result[0]['idsiswa']], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Siswa</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($key['namalengkap']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Nama Panggilan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($key['namapanggilan']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Nama Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['namaortu']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Cabang</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['namacabang']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Alamat</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['alamat']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['tempatlahir']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['tgllahir']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Asal Sekolah</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['asalsekolah']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Kelas</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['kelas']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Tanggal Daftar</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['tgldaftar']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($key['keterangan']);?>" disabled>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <?php } ?>
    <?php ActiveForm::end();?>
</div>