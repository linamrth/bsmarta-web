<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Pembayaran;

use backend\controllers\AdminpembayaranController;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Siswa Kursus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <h3><?= Html::encode($this->title) ?></h3>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $n=0; foreach ($result as $key) { $n++;?>

                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo Html::encode(AdminpembayaranController::tglIndo($key['tanggal'], true));?></td>
                    <td>
                        <?php $pecah = explode('-', $key['tanggal']); ?> 
                        <?php if(($pecah[0].'-'.$pecah[1]) <= date('Y-m')){ ?>
                            <?php if($key['statuspembayaran'] === 'B') { ?>  
                                <?php echo Html::a('<i class="checklist"></i> Belum Bayar',
                                ['checklist','id'=>$key['idpembayaran']],
                                ['class'=>'btn btn-sm btn-danger btn-xs','margin-left'=>'30px'] ); ?>
                            <?php } else { ?>
                                <span class="label label-warning">Sudah Bayar</span>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>