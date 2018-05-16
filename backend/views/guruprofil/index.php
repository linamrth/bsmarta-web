<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use backend\models\Guruskill;
use backend\models\Guru;
use backend\models\Programlevel;
use backend\models\Program;

?>

<div class="profilguru-view">
<h1>Profil guru</h1>
<hr>
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
    
    <?php $guruskill = Guruskill::find()->where(['idguruskill'=>$guruskills[0]['idguruskill']])->one(); ?>
	<?php $nmguru = Guru::find()->where(['idguru'=>$guruskill['idguru']])->one(); ?>

    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Profil Guru</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($nmguru['namaguru']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo Html::encode($nmguru['alamat']);?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Telepon</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($nmguru['telepon']);?>" disabled>
                    </div>
                </div>
                <?php foreach ($guruskills as $key) { ?>
                <?php $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$key['idprogramlevel']])->one(); ?>
				<?php $nmprogram = Program::find()->where(['idprogram'=>$lvprogram['idprogram']])->one(); ?>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Nama Program</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?php echo Html::encode($nmprogram['namaprogram'].' - '.$lvprogram['level']);?>" disabled>
                    </div>
                </div>

                
                <?php } ?>
            </div>
        </div>  
    </div>
    <?php ActiveForm::end();?>
</div>