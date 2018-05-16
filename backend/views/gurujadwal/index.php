<?php
use yii\helpers\Html;
use yii\helpers\Url;

use backend\models\Jadwal;
use backend\models\Trial;
use backend\models\Siswa;
use backend\models\Siswabelajar;
use backend\models\Program;
use backend\models\Programlevel;
use backend\models\Guru;

$hari = [
            'Senin'=>'Senin', 'Selasa'=>'Selasa', 'Rabu'=>'Rabu', 
            'Kamis'=>'Kamis', 'Jumat'=>'Jumat', 'Sabtu'=>'Sabtu'
        ];

$jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

$nmguru = Guru::find()->where(['idguru'=>Yii::$app->user->identity->idguru])->one();
$this->title = "Informasi Jadwal Mengajar Guru ".ucwords($nmguru->namaguru);
?>

<div class="gurujadwal-index">
	<h3 class="text-center"><b><?php echo $this->title;?></b></h3>
	<hr>
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
	                    ->where(['jam'=>$key, 'hari'=>'Senin', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->all();
	            $msenin = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Senin', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->count();

	            $selasa = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Selasa', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->all();
	            $mselasa= Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Selasa', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->count();

	            $rabu   = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Rabu', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->all();
	            $mrabu  = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Rabu', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->count();

	            $kamis  = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Kamis', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->all();
	            $mkamis = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Kamis', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->count();

	            $jumat  = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Jumat', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->all();
	            $mjumat = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Jumat', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->count();
	            
	            $sabtu  = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Sabtu', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->all();
	            $msabtu = Jadwal::find()
	                    ->where(['jam'=>$key, 'hari'=>'Sabtu', 'idguru'=>Yii::$app->user->identity->idguru])
	                    ->count();
	            
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