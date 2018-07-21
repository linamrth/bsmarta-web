<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use backend\models\Cabang;
use backend\models\Guruskill;
use backend\models\Guru;
use backend\models\Programlevel;
use backend\models\Program;

$this->title = $guru->namaguru;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adminguru-view">

  <div class="row">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
    <?php $guru = Guru::find()->where(['idguru'=>$guru['idguru']])->one(); ?>
    <?php $nmcabang = Cabang::find()->where(['idcabang'=>$guru['idcabang']])->one(); ?>

        <div class="col-sm-6">
            <p>
                <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Edit', ['update', 'id' => $guru->idguru], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Hapus', ['delete', 'id' => $guru->idguru], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <div class="panel panel-default">
                <div class="panel-heading">Informasi Guru</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="name">Nama Guru</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="<?php echo Html::encode($guru->namaguru);?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Cabang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="<?php echo Html::encode($nmcabang['namacabang']);?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">No. Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="<?php echo Html::encode($guru->telepon);?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Alamat</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" value="<?php echo Html::encode($guru->alamat);?>" disabled>
                        </div>
                    </div>
                </div>
            </div>  
            <?php ActiveForm::end();?>
        </div> 
        <div class="col-sm-6">
        <p>
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Kemampuan Mengajar Guru', ['createguruskill', 'id' => $guru->idguru], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Kemampuan Mengajar Guru</div>

            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program</th>
                            <th>Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n=0; foreach ($guruskill as $key) { $n++;?>
                        <?php $guruskill = Guruskill::find()->where(['idguruskill'=>$key['idguruskill']])->one(); ?>
                        <?php $nmguru = Guru::find()->where(['idguru'=>$guruskill['idguru']])->one(); ?>

                        <?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$key['idprogramlevel']])->one(); ?>
                        <?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one(); ?>
                            <tr>
                                <td><?php echo $n;?></td>
                                <td><?php echo Html::encode($nmprogram['namaprogram']);?></td>
                                <td><?php echo Html::encode($lvprogram['level']);?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div> 
</div>