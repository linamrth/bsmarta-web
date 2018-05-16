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
    <h3>Pembayaran Siswa Kursus</h3>
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
            <?php $n=0; foreach ($siswabelajars as $key) { $n++;?>
            <?php $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$key['idsiswabelajar']])->one(); ?>
            <?php $siswa = Siswa::find()->where(['idsiswa'=>$siswabelajar['idsiswa']])->one(); ?>
            <?php $nmortu = Orangtua::find()->where(['idorangtua'=>$siswa['idorangtua']])->one(); ?>
            <?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar['idprogramlevel']])->one();?>
            <?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one();?>

                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo Html::encode($siswa['namalengkap']);?></td>
                    <td><?php echo Html::encode($siswa['kelas']);?></td>
                    <td><?php echo Html::encode($nmortu->namaortu);?></td>
                    <td><?php echo Html::encode($nmprogram->namaprogram.' - Level '.$lvprogram->level);?></td>
                    <td>
                        <?php echo Html::a(
                            '<i class="glyphicon glyphicon-search"></i> Detail Pembayaran',
                            ['detailpembayaran','id'=>$key->idsiswabelajar],
                            ['class'=>'btn btn-sm btn-info']
                            );
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>