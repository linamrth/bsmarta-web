<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->namaguru;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adminguru-view">

    <p>
    	<?= Html::a('<i class="glyphicon glyphicon-edit"></i> Edit', ['update', 'id' => $model->idguru], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Hapus', ['delete', 'id' => $model->idguru], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'namaguru',
            [
                'label'=>'Cabang',
                'attribute'=>'idcabang',
                'value'=>$model->getCabang()
            ],
            'telepon',
            'alamat',
        ],
    ]) ?>

</div>