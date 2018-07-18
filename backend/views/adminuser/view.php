<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Daftar User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adminuser-view">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Hapus', ['delete', 'id' => $model->id], [
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
            'username',
            'email',
            [
                'label'=>'Nama Cabang',
                'attribute'=>'idcabang',
                'value'=>$model->getCabang()
            ],
            [
                'label'=>'Level',
                'attribute'=>'level',
                'value'=>$model->getLevel()
            ],
            [
                'label'=>'Nama Guru',
                'attribute'=>'idguru',
                'value'=>$model->getGuru()
            ],
        ],
    ]) ?>

</div>