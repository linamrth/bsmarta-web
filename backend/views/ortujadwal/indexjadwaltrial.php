<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use backend\models\Orangtua;
use backend\models\Siswa;

$this->title = 'Data Siswa || Orang tua';
?>
<h3>Data Siswa Trial</h3>
<hr>

<div class="row">
    <div class="col-sm-12">
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Program</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=0; foreach ($result as $key) { $n++;?>

                        <tr>
                            <td><?php echo $n;?></td>
                            <td><?php echo Html::encode($key['namalengkap']);?></td>
                            <td><?php echo Html::encode($key['kelas']);?></td>
                            <td><?php echo Html::encode($key['namaprogram']);?></td>
                            <td>
                                <?php echo Html::a(
                                '<i class="glyphicon glyphicon-search"></i> Lihat Jadwal Trial',
                                ['jadwaltrial','id'=>$key['idtrial']],
                                ['class'=>'btn btn-sm btn-info']
                                );
                            ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>