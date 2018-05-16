<?php
use yii\helpers\Html;

use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
$this->title = 'Grafik Perkembangan Hasil Belajar Siswa || Guru';
?>
<?php echo Html::a('Kembali',['allsiswaview', 'id'=>$back],['class'=>'btn btn-sm btn-primary']);?>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height'=>200,
        'width'=>400,
    ],
    'clientOptions'=>[
        'title'=>[
            'display'=>true,
            'text'=>'Grafik Perkembangan Hasil Belajar Siswa'
        ],
        'tooltips'=> [
            'mode'=>'index',
            'intersect'=>false,
        ],
        'hover'=>[
            'mode'=>'nearest',
            'intersect'=> true
        ],
        'scales'=> [
            'xAxes'=>[[
                'display'=> true,
                'scaleLabel'=> [
                    'display'=> true,
                    'labelString'=> 'Pertemuan'
                ]
            ]],
            'yAxes'=>[[
                'display'=> true,
                'scaleLabel'=> [
                    'display'=> true,
                    'labelString'=> 'Halaman'
                ]
            ]]
        ],
    ],
    'data' => [
        'labels' => $pertemuan,
        'datasets' => [
            [
                'label' => "Target Ketercapaian",
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $target
            ],
            [
                'label' => "Hasil Ketercapaian",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $hasiltarget
            ]
        ]
    ],    
]);
?>