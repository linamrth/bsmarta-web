<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = $result[0]['namalengkap'];
$this->params['breadcrumbs'][] = ['label' => 'Siswa Kursus', 'url' => ['siswakursus']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="informasitrial-view">
<h3><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
    <?php foreach ($result as $key) { ?>
    
    <p>
        <?= Html::a('Update', ['updatesiswa', 'id' => $result[0]['idsiswa']], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Siswa</div>
            <div class="panel-body">
                <?= DetailView::widget([
                        'model' => $key,
                        'attributes' => [
                            [
                                'attribute'=>'foto',
                                'value'=>Yii::getAlias('@belakang/images/'.$key['foto']),
                                'format'=>['image',['class'=>'img-thumbnail img-responsive', 'width'=>'150px']],
                            ],
                            'namalengkap',
                            'namapanggilan',
                            'namaortu',
                            'namacabang',
                            // ['attribute'=>'idcabang', 'value'=>$result->getCabang(), 'label'=>'Cabang'],
                            'alamat',
                            'tempatlahir',
                            'tgllahir',
                            'asalsekolah',
                            'kelas',
                            'tgldaftar',
                            'keterangan',
                        ],
                    ]) ?>
            </div>
        </div>  
    </div>
    <?php } ?>
    <?php ActiveForm::end();?>
</div>