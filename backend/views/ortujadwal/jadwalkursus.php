<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use backend\controllers\AdminkursusController;

$jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

$this->title = $siswabelajar->getSiswa();
$this->params['breadcrumbs'][] = ['label' => 'Data Siswa Kursus', 'url' => ['indexjadwalkursus']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasikursus-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>

    <div class="col-sm-12">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Siswa Kursus</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($siswabelajar->getSiswa());?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Program</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($siswabelajar->getProgram());?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Level</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($siswabelajar->getLevel());?>" disabled>
                    </div>
                </div>
            </div>
        </div> 
        <?php ActiveForm::end();?> 
    </div>
    
    <hr>

    <h3>Jadwal Dalam Seminggu</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php $n=0; foreach ($jadwal as $key) { $n++; ?>
            <tr>
                <td><?php echo $n;?></td>
                <td><?php echo Html::encode($key->getNamaguru());?></td>
                <td><?php echo Html::encode($key['hari']);?></td>
                <td><?php echo Html::encode($key['tanggal']);?></td>
                <td><?php echo Html::encode($jam[$key['jam']]);?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <hr>
    <?php if(count($jadwalgenerate) == 0){ ?>
        <p class="text-center">Tidak ada jadwal!</p>
    <?php } else { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pertemuan Ke</th>
                    <th>Program</th>
                    <th>Guru</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $n=0; foreach ($jadwalgenerate as $key) { $n++; ?>
                <tr>
                    <td><?php echo Html::encode($n);?></td>
                    <td><?php echo Html::encode($key->getProgramlevel());?></td>
                    <td><?php echo Html::encode($key->getNamaGuru());?></td>
                    <td><?php echo Html::encode(AdminkursusController::tglIndo($key->tanggal, true));?></td>
                    <td><?php echo Html::encode($key->getJam());?></td>
                </tr>
                <?php } ?> 
            </tbody>
        </table>
    <?php } ?>
</div>
