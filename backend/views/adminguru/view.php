<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->namaguru;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adminguru-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?= Html::a('Update', ['update', 'id' => $model->idguru], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idguru], [
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