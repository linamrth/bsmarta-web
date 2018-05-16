<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $level = array("1"=>"ADMINISTRATOR","2"=>"BAGIANKURIKULUM","3"=>"GURU","4"=>"ORANGTUA","5"=>"DIREKTUR","6"=>"PIMPINAN");

    if(Yii::$app->user->isGuest) $judul="BSMART RUMAH BELAJAR";
    else $judul = $level[Yii::$app->user->identity->level];

    NavBar::begin([
        'brandLabel' => $judul,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }
    else {

        // $menuItems = [
        //     ['label' => 'Administrator', 'items'=>[
        //             ['label' => 'Cabang', 'url' => ['/admincabang/index']],
        //             ['label' => 'Guru', 'url' => ['/adminguru/index']],
        //             ['label' => 'Skill Guru', 'url' => ['/adminguruskill/index']],
        //             ['label' => 'User', 'url' => ['/adminuser/index']],
        //             ['label' => 'Trial', 'items'=>[
        //                     ['label'=>'Daftar Siswa Trial', 'url' => ['/admintrial/index']],
        //                     ['label'=>'Siswa Trial', 'url' => ['/admintrial/siswatrial']],
        //                 ]
        //             ],
        //             ['label' => 'Kursus', 'items'=>[
        //                     ['label' => 'Daftar Siswa Kursus', 'url' => ['/adminkursus/index']],
        //                     ['label'=>'Siswa Kursus', 'url' => ['/adminkursus/siswakursus']],
        //                 ]
        //             ],
        //             ['label' => 'Pembayaran Kursus', 'url' => ['/adminpembayaran/index']],
        //         ]
        //     ],
        //     ['label' => 'Kurikulum', 'items'=>[
        //             ['label' => 'Program', 'url' => ['/kurikulumprogram/index']],
        //             ['label' => 'Materi', 'url' => ['/kurikulummateri/index']],
        //             ['label' => 'Lesson Plan', 'url' => ['/kurikulumlessonplan/index']],
        //         ]
        //     ],
        //     ['label' => 'Guru', 'items'=>[
        //             ['label' => 'Jadwal Mengajar', 'url' => ['/gurujadwal/index']],
        //             ['label' => 'Siswa', 'items'=>[
        //                     ['label'=>'Siswa Pribadi', 'url' => ['/gurusiswa/index']],
        //                     ['label'=>'Semua Siswa', 'url' => ['/gurusiswa/allsiswa']],
        //                 ]   
        //             ],
        //             ['label' => 'Profil', 'url' => ['/guruprofil/index']],
        //         ]
        //     ],
            
        //     ['label' => 'Orang Tua', 'items'=>[
        //             ['label' => 'Jadwal Siswa', 'items'=>[
        //                     ['label' => 'Jadwal Trial', 'url' => ['/ortujadwal/indexjadwaltrial']],
        //                     ['label' => 'Jadwal Kursus', 'url' => ['/ortujadwal/indexjadwalkursus']],
        //                 ]
        //             ],
        //             ['label' => 'Rapot Siswa', 'items'=>[
        //                     ['label'=>'Rapot Trial', 'url' => ['/orturapotsiswa/indexrapottrial']],
        //                     ['label'=>'Perkembangan Hasil Belajar', 'url' => ['/orturapotsiswa/indexrapotkursus']],
        //                 ]
        //             ],
        //             ['label' => 'Pembayaran Kursus', 'url' => ['/ortupembayaran/index']],
        //             ['label' => 'Kuisioner', 'url' => ['/ortukuisioner/index']],
        //         ]
        //     ],
        //     ['label' => 'Direktur', 'items'=>[
        //             ['label' => 'Program', 'url' => ['/direkturprogram/index']],
        //             ['label' => 'Rapot Siswa', 'items'=>[
        //                     ['label'=>'Rapot Trial', 'url' => ['/direkturrapotsiswa/siswatrial']],
        //                     ['label'=>'Perkembangan Hasil Belajar', 'url' => ['/direkturrapotsiswa/allsiswa']],
        //                 ]
        //             ],
        //             ['label' => 'Pembayaran Kursus', 'url' => ['/direkturpembayaran/index']],
        //             ['label' => 'Kinerja Guru', 'url' => ['/direkturkinerjaguru/index']],
        //         ]
        //     ],
        //     ['label' => 'Pimpinan', 'items'=>[
        //             ['label' => 'Program', 'url' => ['/pimpinanprogram/index']],
        //             ['label' => 'Rapot Siswa', 'items'=>[
        //                     ['label'=>'Rapot Trial', 'url' => ['/pimpinanrapotsiswa/siswatrial']],
        //                     ['label'=>'Perkembangan Hasil Belajar', 'url' => ['/pimpinanrapotsiswa/allsiswa']],
        //                 ]
        //             ],
        //             ['label' => 'Pembayaran Kursus', 'url' => ['/pimpinanpembayaran/index']],
        //         ]
        //     ],
        // ];

        //user administrator
        if(Yii::$app->user->identity->level == 1){
            $menuItems = [
                ['label' => 'Cabang', 'url' => ['/admincabang/index']],
                ['label' => 'Guru', 'url' => ['/adminguru/index']],
                ['label' => 'Skill Guru', 'url' => ['/adminguruskill/index']],
                ['label' => 'User', 'url' => ['/adminuser/index']],
                ['label' => 'Trial', 'items'=>[
                        ['label'=>'Daftar Siswa Trial', 'url' => ['/admintrial/index']],
                        ['label'=>'Siswa Trial', 'url' => ['/admintrial/siswatrial']],
                    ]
                ],
                ['label' => 'Kursus', 'items'=>[
                        ['label' => 'Daftar Siswa Kursus', 'url' => ['/adminkursus/index']],
                        ['label'=>'Siswa Kursus', 'url' => ['/adminkursus/siswakursus']],
                    ]
                ],
                ['label' => 'Pembayaran Kursus', 'url' => ['/adminpembayaran/index']],
            ];
        }

        //user kurikulum
        else if (Yii::$app->user->identity->level == 2) {
            $menuItems = [
                ['label' => 'Program', 'url' => ['/kurikulumprogram/index']],
                ['label' => 'Materi', 'url' => ['/kurikulummateri/index']],
                ['label' => 'Lesson Plan', 'url' => ['/kurikulumlessonplan/index']],
            ];
        }

        //user guru
        else if (Yii::$app->user->identity->level == 3) {
            $menuItems = [
                ['label' => 'Jadwal Mengajar', 'url' => ['/gurujadwal/index']],
                ['label' => 'Rapot Siswa', 'items'=>[
                        ['label'=>'Siswa Pribadi', 'url' => ['/gurusiswa/index']],
                        ['label'=>'Semua Siswa', 'url' => ['/gurusiswa/allsiswa']],
                    ]   
                ],
                ['label' => 'Profil', 'url' => ['/guruprofil/index']],
            ];
        }

        //user orang tua
        else if (Yii::$app->user->identity->level == 4) {
            $menuItems = [
                ['label' => 'Jadwal Siswa', 'items'=>[
                        ['label' => 'Jadwal Trial', 'url' => ['/ortujadwal/indexjadwaltrial']],
                        ['label' => 'Jadwal Kursus', 'url' => ['/ortujadwal/indexjadwalkursus']],
                    ]
                ],
                ['label' => 'Rapot Siswa', 'items'=>[
                        ['label'=>'Rapot Trial', 'url' => ['/orturapotsiswa/indexrapottrial']],
                        ['label'=>'Perkembangan Hasil Belajar', 'url' => ['/orturapotsiswa/indexrapotkursus']],
                    ]
                ],
                ['label' => 'Pembayaran Kursus', 'url' => ['/ortupembayaran/index']],
                ['label' => 'Kuisioner', 'url' => ['/ortukuisioner/index']],
            ];
        }

        //user direktur
        else if (Yii::$app->user->identity->level == 5) {
            $menuItems = [
                ['label' => 'Program', 'url' => ['/direkturprogram/index']],
                ['label' => 'Rapot Siswa', 'items'=>[
                        ['label'=>'Rapot Trial', 'url' => ['/direkturrapotsiswa/siswatrial']],
                        ['label'=>'Perkembangan Hasil Belajar', 'url' => ['/direkturrapotsiswa/allsiswa']],
                    ]
                ],
                ['label' => 'Pembayaran Kursus', 'url' => ['/direkturpembayaran/index']],
                ['label' => 'Kinerja Guru', 'url' => ['/direkturkinerjaguru/index']],
            ];
        }

        //user pimpinan
        else {
            $menuItems = [
                ['label' => 'Program', 'url' => ['/pimpinanprogram/index']],
                ['label' => 'Rapot Siswa', 'items'=>[
                        ['label'=>'Rapot Trial', 'url' => ['/pimpinanrapotsiswa/siswatrial']],
                        ['label'=>'Perkembangan Hasil Belajar', 'url' => ['/pimpinanrapotsiswa/allsiswa']],
                    ]
                ],
                ['label' => 'Pembayaran Kursus', 'url' => ['/pimpinanpembayaran/index']],
            ];
        }

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Lina Meritha - Teknik Informatika (<a target="_blank" href="https://pens.ac.id/">PENS</a>) <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
