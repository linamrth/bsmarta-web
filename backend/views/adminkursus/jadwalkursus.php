<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;

use backend\models\Siswabelajar;
use backend\models\Jadwal;
use backend\models\Siswa;
use backend\models\Program;
use backend\models\Programlevel;
use backend\models\Guru;
use backend\models\Guruskill;
use backend\models\Trial;

$hari = [
            'Senin'=>'Senin', 'Selasa'=>'Selasa', 'Rabu'=>'Rabu', 
            'Kamis'=>'Kamis', 'Jumat'=>'Jumat', 'Sabtu'=>'Sabtu'
        ];

$jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

$siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$siswabelajar->idsiswabelajar])->one();
$nmsiswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();

$siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$siswabelajar->idsiswabelajar])->one();
$programlevel = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
$nmprogram = Program::find()->where(['idprogram'=>$programlevel->idprogram])->one();
?>

<div class="jadwaltrial-view">
<?php $form = ActiveForm::begin();?>
    <h3>
        <?= Html::encode($nmsiswa->namalengkap). ' - '. 
            Html::encode($nmprogram->namaprogram). ' '.
            Html::encode($programlevel->level) ?>
    </h3>

    <hr>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Informasi Jadwal</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n=0; foreach ($guru as $key) { $n++;?>
                        <tr>
                            <td><?php echo $n;?></td>
                            <td>
                                <?php echo Html::encode($key['namaguru']);?>
                            </td>
                            <td>
                                <?php echo Html::a(
                                    '<i class="glyphicon glyphicon-search"></i> Lihat Jadwal', 
                                    ['popup'], 
                                    [
                                        'class'=>'btn btn-primary btn-sm pull-right', 
                                        'title'=>'Lihat Jadwal Guru',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'#myModalGuru'.$key['idguru'],
                                    ]);?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Form Daftar Jadwal Kursus</div>
            <div class="panel-body">
                <?= $form->field($model, 'idguruskill')->dropDownList(
                        $gurunya, 
                        ['prompt'=>'-Pilih Nama Guru-']
                    )->label('Guru') ?>

                <?= $form->field($model, 'hari[]')->dropDownList(
                        $model->getHari(), 
                        ['prompt'=>'-Pilih Hari Ke 1-']
                    )->label('Pilih Hari') ?>

                <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                    'options' => [
                        'placeholder' => 'Input Tanggal Ke 1',
                        'name' => 'JadwalkursusForm[tanggal][]',
                        'id' => 'tanggal-id0',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>

                <?= $form->field($model, 'jam[]')->dropDownList(
                        $model->getJam(), 
                        ['prompt'=>'-Pilih Jam-']
                    )->label('Pilih Jam') ?>

                <?= $form->field($model, 'hari[]')->dropDownList(
                        $model->getHari(), 
                        ['prompt'=>'-Pilih Hari Ke 2-']
                    )->label('Pilih Hari') ?>

                <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                    'options' => [
                        'placeholder' => 'Input Tanggal Ke 2',
                        'name' => 'JadwalkursusForm[tanggal][]',
                        'id' => 'tanggal-id1',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>

                <?= $form->field($model, 'jam[]')->dropDownList(
                        $model->getJam(), 
                        ['prompt'=>'-Pilih Jam-']
                    )->label('Pilih Jam') ?>

                <?php echo Html::submitButton('Buat Jadwal Kursus', ['class'=>'btn btn-success']);?>
            </div>
        </div> 
        <?php ActiveForm::end();?> 
    </div>
</div>

<?php foreach ($gurus as $key1) { 
        $namaguru = Guru::findOne(["idguru"=>$key1->idguru]);
    ?>

<div id="myModalGuru<?php echo $key1->idguru;?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Jadwal Mengajar <b><?php echo $namaguru->namaguru;?></b></h4>
            </div>
            
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Jam \ Hari</th>
                            <?php foreach ($hari as $key => $value) { ?>
                                <th class="text-center"><?php echo Html::encode($value);?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jam as $key => $value) { 
                            
                            $senin  = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Senin', 'idguru'=>$key1->idguru])
                                    ->all();
                            $msenin = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Senin', 'idguru'=>$key1->idguru])
                                    ->all();
                            $csenin = count($msenin);

                            $selasa = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Selasa', 'idguru'=>$key1->idguru])
                                    ->all();
                            $mselasa= Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Selasa', 'idguru'=>$key1->idguru])
                                    ->all();
                            $cselasa= count($mselasa);

                            $rabu   = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Rabu', 'idguru'=>$key1->idguru])
                                    ->all();
                            $mrabu  = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Rabu', 'idguru'=>$key1->idguru])
                                    ->all();
                            $crabu  = count($mrabu);

                            $kamis  = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Kamis', 'idguru'=>$key1->idguru])
                                    ->all();
                            $mkamis = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Kamis', 'idguru'=>$key1->idguru])
                                    ->all();
                            $ckamis = count($mkamis);

                            $jumat  = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Jumat', 'idguru'=>$key1->idguru])
                                    ->all();
                            $mjumat = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Jumat', 'idguru'=>$key1->idguru])
                                    ->all();
                            $cjumat = count($mjumat);
                            
                            $sabtu  = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Sabtu', 'idguru'=>$key1->idguru])
                                    ->all();
                            $msabtu = Jadwal::find()
                                    ->where(['jam'=>$key, 'hari'=>'Sabtu', 'idguru'=>$key1->idguru])
                                    ->all();
                            $csabtu = count($msabtu);
                            
                            ?>
                            <tr>
                                <td class="text-center"><b><?php echo Html::encode($value);?></b></td>
                                <td class="text-center">
                                    <?php foreach ($senin as $key2) { 
                                        $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                                        $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                                        $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                                        $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                                        $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                                        $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                                        $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                                        
                                        $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                                        $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

                                        if($key2['statusjadwal'] === 'T') {
                                            echo $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                        } 
                                       elseif($key2['statusjadwal'] === 'K'){
                                            echo $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                       }else{
                                            echo '';
                                       }
                                    } ?>
                                    
                                </td>
                                <td class="text-center">
                                    <?php foreach ($selasa as $key2) { 
                                        $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                                        $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                                        $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                                        $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                                        $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                                        $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                                        $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                                        
                                        $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                                        $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

                                        if($key2['statusjadwal'] === 'T') {
                                            echo $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                        } 
                                       elseif($key2['statusjadwal'] === 'K'){
                                            echo $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                       }else{
                                            echo '';
                                       }
                                    } ?>
                                    
                                </td>
                                <td class="text-center">
                                    <?php foreach ($rabu as $key2) { 
                                        $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                                        $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                                        $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                                        $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                                        $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                                        $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                                        $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                                        
                                        $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                                        $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

                                        if($key2['statusjadwal'] === 'T') {
                                            echo $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                        } 
                                       elseif($key2['statusjadwal'] === 'K'){
                                            echo $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                       }else{
                                            echo '';
                                       }
                                    } ?>
                                    
                                </td>
                                <td class="text-center">
                                    <?php foreach ($kamis as $key2) { 
                                        $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                                        $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                                        $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                                        $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                                        $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                                        $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                                        $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                                        
                                        $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                                        $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

                                        if($key2['statusjadwal'] === 'T') {
                                            echo $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                        } 
                                       elseif($key2['statusjadwal'] === 'K'){
                                            echo $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                       }else{
                                            echo '';
                                       }
                                    } ?>
                                    
                                </td>
                                <td class="text-center">
                                    <?php foreach ($jumat as $key2) { 
                                        $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                                        $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                                        $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                                        $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                                        $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                                        $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                                        $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                                        
                                        $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                                        $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

                                        if($key2['statusjadwal'] === 'T') {
                                            echo $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                        } 
                                       elseif($key2['statusjadwal'] === 'K'){
                                            echo $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                       }else{
                                            echo '';
                                       }
                                    } ?>
                                  
                                </td>
                                <td class="text-center">
                                    <?php foreach ($sabtu as $key2) { 
                                        $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                                        $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                                        $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                                        $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                                        $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                                        $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                                        $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                                        
                                        $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                                        $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

                                        if($key2['statusjadwal'] === 'T') {
                                            echo $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                        } 
                                       elseif($key2['statusjadwal'] === 'K'){
                                            echo $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')'.'<br>';
                                       }else{
                                            echo '';
                                       }
                                    } ?>
                                  
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php } ?>