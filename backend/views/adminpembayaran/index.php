<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Program;

$this->title = 'Siswa Kursus || Admin';
?>

<div class="row">
    <h3>Pembayaran Biaya Kursus</h3>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nama Orangtua</th>
                <th>Program Kursus</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $n=0; foreach ($result as $key) { $n++;?>
                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo Html::encode($key['namalengkap']);?></td>
                    <td><?php echo Html::encode($key['kelas']);?></td>
                    <td><?php echo Html::encode($key['namaortu']);?></td>
                    <td><?php echo Html::encode($key['namaprogram'].' - Level '.$key['level']);?></td>
                    <td>
                        <?php echo Html::a(
                            '<i class="glyphicon glyphicon-search"></i> Detail Pembayaran',
                            ['detailpembayaran','id'=>$key['idsiswabelajar']],
                            ['class'=>'btn btn-sm btn-info']
                            );
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>