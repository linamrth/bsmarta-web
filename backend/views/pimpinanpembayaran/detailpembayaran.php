<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Pembayaran;

use backend\controllers\PimpinanpembayaranController;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Siswa Kursus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

function angkaRupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
 
}
?>

<div class="row">
    <h3><?= Html::encode($this->title) ?></h3>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Hari dan Tanggal</th>
                <th>Program Kursus</th>
                <th>Biaya Kursus</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $n=0; foreach ($result as $key) { $n++;?>

                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo Html::encode(PimpinanpembayaranController::tglIndo($key['tanggal'], true));?></td>
                    <td><?php echo Html::encode($key['namaprogram'].' - Level '.$key['level']);?></td>
                    <td><?= angkaRupiah($key['biayakursus']);?></td>
                    <td>
                        <?php if($key['statuspembayaran'] === 'B') { ?>  
                            <span class="label label-danger">Belum Bayar</span>
                        <?php } else { ?>
                            <span class="label label-success">Sudah Bayar</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>