<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use backend\models\Orangtua;
use backend\models\Siswa;

$this->title = $ortus->namaortu;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Orang Tua', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
        <div class="col-sm-4">
        <p>
            <?= Html::a('Update', ['update', 'id' => $ortus->idorangtua], ['class' => 'btn btn-primary']) ?>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Orang Tua</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo Html::encode($ortus->namaortu);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php echo Html::encode($ortus->jeniskelamin);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">No Telepon</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" value="<?php echo Html::encode($ortus->telepon);?>" disabled>
                    </div>
                </div>
            </div>
        </div>  
        <?php ActiveForm::end();?>
    </div>

    <div class="col-sm-8">
        <p>
            <?= Html::a('Tambah Data Siswa', ['daftarsiswa', 'id'=>$ortus->idorangtua], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">Data Anak</div>

            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Asal Sekolah</th>
                            <th>Status Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n=0; foreach ($siswas as $key) { $n++;?>

                            <tr>
                                <td><?php echo $n;?></td>
                                <td><?php echo Html::encode($key['namalengkap']);?></td>
                                <td><?php echo Html::encode($key['kelas']);?></td>
                                <td><?php echo Html::encode($key['asalsekolah']);?></td>
                                <td>
                                    <?php if($key['statussiswa'] === 'Y') { ?> 
                                        <span class="label label-info">Siswa Kursus</span>  
                                    <?php } elseif($key['statussiswa'] === 'N')  { ?>
                                        <span class="label label-danger">Belum Trial</span>
                                         <?php echo Html::a('Daftar Program Trial', ['daftarprogramtrial', 'id'=>$key['idsiswa']], ['class'=>'btn btn-warning btn-xs','margin-left'=>'30px'] ); ?>
                                    <?php }elseif($key['statussiswa'] === 'M')  { ?>
                                        <span class="label label-success">Selesai Trial</span>
                                    <?php }else{?>
                                        <span class="label label-primary">Sudah Daftar Trial</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>