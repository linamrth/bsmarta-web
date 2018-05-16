<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->namaprogram;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kurikulumprogram-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?= Html::a('Update', ['update', 'id' => $model->idprogram], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idprogram], [
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
            'namaprogram',
            'deskripsi',
            'fasilitas',
            'biayadaftar',
            'biayakursus',
            'biayatambahan',
        ],
    ]) ?>

</div>