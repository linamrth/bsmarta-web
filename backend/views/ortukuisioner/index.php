<?php
use yii\helpers\Html;
use yii\grid\Gridview;
use yii\widgets\ActiveForm;

use backend\models\Siswabelajar;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Orangtua;

$this->title = 'Pembayaran || Admin';
?>

<div class="row">
    <h3>Data Siswa Kursus</h3>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
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
                    <td><?php echo Html::encode($key['namaprogram'].' - Level '.$key['level']);?></td>
                    <td>
                        <?php echo Html::a(
                            '<i class="glyphicon glyphicon-search"></i> Detail Kuisioner',
                            ['view','id'=>$key['idsiswabelajar']],
                            ['class'=>'btn btn-sm btn-info']
                            );
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>