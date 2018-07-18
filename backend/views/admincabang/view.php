<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->namacabang;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Cabang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admincabang-view">
    <p>
    	<?= Html::a('<i class="glyphicon glyphicon-edit"></i> Edit', ['update', 'id' => $model->idcabang], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Hapus', ['delete', 'id' => $model->idcabang], [
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
            'namacabang',
            'jenis',
            'alamat',
            'telepon',
            'fax',
            'kabupaten',
        ],
    ]) ?>

</div>