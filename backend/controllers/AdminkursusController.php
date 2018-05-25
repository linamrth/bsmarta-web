<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;

use backend\models\Orangtua;
use backend\models\Siswa;
use backend\models\Siswabelajar;
use backend\models\SiswabelajarForm;
use backend\models\Trial;
use backend\models\Program;
use backend\models\Programlevel;
use backend\models\Jadwal;
use backend\models\JadwalkursusForm;
use backend\models\Jadwalgenerate;
use backend\models\Guru;
use backend\models\Guruskill;
use backend\models\Rapottrial;
use backend\models\RapottrialcintabacaForm;
use backend\models\RapottrialcintamatikaForm;
use backend\models\Pembayaran;
use backend\models\Kuisioner;

class AdminkursusController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, orangtua.namaortu, program.namaprogram, guru.namaguru, rapottrial.idhasiltrial
            FROM rapottrial
            INNER JOIN jadwal ON rapottrial.idjadwal = jadwal.idjadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            INNER JOIN program ON trial.idprogram = program.idprogram
            ORDER BY siswa.namalengkap");

        $result = $command->queryAll();
        
        return $this->render('index', ['result'=>$result]);
    }

    public function actionDaftarprogramkursus($id)
    {
    	$getrapottrial  = Rapottrial::find()->where(['idhasiltrial'=>$id])->one();
        $getjadwal      = Jadwal::find()->where(['idjadwal'=>$getrapottrial->idjadwal])->one();
        $gettrial       = Trial::find()->where(['idtrial'=>$getjadwal->idtrial])->one();
        $getsiswa       = Siswa::find()->where(['idsiswa'=>$gettrial->idsiswa])->one();
        $getortu        = Orangtua::find()->where(['idorangtua'=>$getsiswa->idorangtua])->one();

    	$tabel = new Siswabelajar();
    	$model = new SiswabelajarForm();

        if ($model->load(Yii::$app->request->post())) {
        	$tabel->idsiswa         = $model->idsiswa;
            $tabel->idprogramlevel  = $model->idprogramlevel;
            $tabel->idcabang        = Yii::$app->user->identity->idcabang;
            $tabel->tgldaftar       = date('Y-m-d H:i:s');
            $tabel->save();

            return $this->redirect(['jadwalkursus', 'id'=>$tabel->idsiswabelajar]);
        }
        else{
            $model->idsiswa = $getsiswa->idsiswa;
            return $this->render('daftarprogramkursus', [
                'rapottrial'=>$getrapottrial,
                'jadwal'=>$getjadwal,
                'trial'=>$gettrial,
                'siswa'=>$getsiswa,
                'ortu'=>$getortu,
                'model'=>$model
            ]);
        }
    }

    public function actionJadwalkursus($id)
    {
        $getsiswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$id])->one();
        $getsiswa        = Siswa::find()->where(['idsiswa'=>$getsiswabelajar->idsiswa])->one();
        $getortu         = Orangtua::find()->where(['idorangtua'=>$getsiswa->idorangtua])->one();
        $getprogramlevel = Programlevel::find()->where(['idprogramlevel'=>$getsiswabelajar->idprogramlevel])->one();

        $gurunya = Guruskill::find()
                    ->select('guruskill.*, guru.*')
                    ->leftJoin('guru', 'guru.idguru = guruskill.idguru')
                    ->where([
                        'guru.idcabang'=>Yii::$app->user->identity->idcabang, 
                        'idprogramlevel'=>$getsiswabelajar->idprogramlevel])
                    ->asArray()
                    ->all();

        $gurus = Guruskill::find()
                    ->leftJoin('guru', 'guru.idguru = guruskill.idguru')
                    ->where([
                        'guru.idcabang'=>Yii::$app->user->identity->idcabang, 
                        'idprogramlevel'=>$getsiswabelajar->idprogramlevel])
                    ->all();

        $arrayGuru = ArrayHelper::map($gurunya, 'idguru', function($model){ 
            return $model['namaguru'];
        });

        $model = new JadwalkursusForm();

        if($model->load(Yii::$app->request->post())){
            for ($i=0; $i < count($model->hari); $i++) { 
                $tabel = new Jadwal();
                
                $tabel->idsiswabelajar  = $getsiswabelajar->idsiswabelajar;
                $tabel->idtrial         = 0;
                $tabel->idguru          = $model->idguruskill;
                $tabel->hari            = $model->hari[$i];
                $tabel->tanggal         = $model->tanggal[$i];
                $tabel->jam             = $model->jam[$i];
                $tabel->statusjadwal    = 'K';
                $tabel->save();
            }
            
            $getsiswa->statussiswa = 'Y';
            $getsiswa->save();

            return $this->redirect(['siswakursus']);
        }
        else{
            return $this->render('jadwalkursus', [
                'siswabelajar'=>$getsiswabelajar,
                'siswa'=>$getsiswa,
                'ortu'=>$getortu,
                'programlevel'=>$getprogramlevel,
                'guru'=>$gurunya,
                'gurunya'=>$arrayGuru,
                'gurus'=>$gurus,
                'model'=>$model
            ]);
        }
    }

    public function actionEditjadwalkursus($id)
    {
        $model = new JadwalkursusForm();

        $getjadwal =  Jadwal::find()->where(['idjadwal'=>$id])->one();
        $getsiswabelajar =  Siswabelajar::find()->where(['idsiswabelajar'=>$getjadwal->idsiswabelajar])->one();
        $getsiswa =  Siswa::find()->where(['idsiswa'=>$getsiswabelajar->idsiswa])->one();

        $gurunya = Guruskill::find()
            ->select('guruskill.*, guru.*')
            ->leftJoin('guru', 'guru.idguru = guruskill.idguru')
            ->where([
                'guru.idcabang'=>Yii::$app->user->identity->idcabang, 
                'idprogramlevel'=>$getsiswabelajar->idprogramlevel])
            ->asArray()
            ->all();

        $gurus = Guruskill::find()
            ->leftJoin('guru', 'guru.idguru = guruskill.idguru')
            ->where([
                'guru.idcabang'=>Yii::$app->user->identity->idcabang, 
                'idprogramlevel'=>$getsiswabelajar->idprogramlevel])
            ->all();

        $arrayGuru = ArrayHelper::map($gurunya, 'idguru', function($model){ 
            return $model['namaguru'];
        });

        if ($model->load(Yii::$app->request->post())) {
            $getjadwal->idsiswabelajar = $getsiswabelajar->idsiswabelajar;
            $getjadwal->idguru = $model->idguruskill;
            $getjadwal->hari = $model->hari;
            $getjadwal->jam = $model->jam;
            $getjadwal->tanggal = $model->tanggal;
            $getjadwal->save();
            return $this->redirect(['informasikursus', 'id' => $getsiswabelajar->idsiswabelajar ]);
        } else {
            $model->idguruskill = $getjadwal->idguru;
            $model->hari = $getjadwal->hari;
            $model->jam = $getjadwal->jam;
            $model->tanggal = $getjadwal->tanggal;

            return $this->render('editjadwalkursus', [
                'siswa'=>$getsiswa,
                'guru'=>$gurunya,
                'siswabelajar'=>$getsiswabelajar,
                'gurunya'=>$arrayGuru,
                'gurus'=>$gurus,
                'model'=>$model,
            ]);    
        }
    }

    protected function findModeljadwal($id)
    {
        if (($model = Jadwal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSiswakursus()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            ORDER BY siswa.namalengkap");

        $result = $command->queryAll();
        
        return $this->render('siswakursus', ['result'=>$result]);
    }

    public function actionDetailsiswa($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, orangtua.namaortu, cabang.namacabang
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            INNER JOIN cabang ON siswa.idcabang = cabang.idcabang
            WHERE siswabelajar.idsiswabelajar = '".$id."'");

        $result = $command->queryAll();
        
        return $this->render('detailsiswa', ['result'=>$result]);
    }

    public function actionUpdatesiswa($id)
    {
        $model = $this->findModelsiswa($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $idsiswa = $model->idsiswa;
            $siswabelajar = Siswabelajar::find()->where(['idsiswa'=>$idsiswa])->one();

            return $this->redirect(['detailsiswa', 'id' => $siswabelajar->idsiswabelajar ]);
        } else {
            return $this->render('updatesiswa', ['model' => $model]);
        }
    }

    protected function findModelsiswa($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInformasikursus($id)
    {
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$id])->one();
        $jadwal = Jadwal::find()->where(['idsiswabelajar'=>$id])->all();
        $jadwalgenerate = Jadwalgenerate::find()->where(['idsiswabelajar'=>$id])->orderBy(['tanggal'=>SORT_ASC])->all();
        
        return $this->render('informasikursus', [
            'siswabelajar'=>$siswabelajar,
            'jadwal'=>$jadwal,
            'jadwalgenerate'=>$jadwalgenerate
        ]);
    }

    public function actionUpdatesiswabelajar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['informasikursus', 'id' => $model->idsiswabelajar]);
        } else {
            return $this->render('updatesiswabelajar', ['model' => $model]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Siswabelajar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGeneratejadwal($id)
    {
        $carisispro = Siswabelajar::find()->where(['idsiswabelajar'=>$id])->one();
        $cariprogra = Programlevel::find()->where(['idprogramlevel'=>$carisispro['idprogramlevel']])->one();

        $itungjadwal = Jadwal::find()->where(['idsiswabelajar'=>$id])->count();
        $carijadwal = Jadwal::find()->where(['idsiswabelajar'=>$id])->all();

        $cariortunya = Siswa::find()->where(['idsiswa'=>$carisispro->idsiswa])->one();

        //untuk input ke kuisioner
        $mingguadd = 0;
        for ($i=0; $i < $cariprogra['jmlpertemuan']; $i+=2) { 
            $tglsekarang = $carijadwal[1]['tanggal'];
            $kuisioner = new Kuisioner();
            if($i == 0){
                $kuisioner->tanggal = $tglsekarang;
            }
            else{
                $generate = strtotime("+".$mingguadd." week", strtotime($tglsekarang));
                $tglnyaaa = date("Y-m-d", $generate);
                $kuisioner->tanggal = $tglnyaaa;   
            }
            $kuisioner->idorangtua = $cariortunya->idorangtua;
            $kuisioner->idsiswabelajar = $id;
            $kuisioner->idguru = $carijadwal[1]['idguru'];

            $kuisioner->save();
            $mingguadd++;
        }

        //untuk input ke pembayaran
        $bulanadd = 0;
        for($i=0; $i < $cariprogra['jmlpertemuan']; $i+=8){
            $tglsekarang = $carijadwal[0]['tanggal'];
            $bayar = new Pembayaran();
            $bayar->idsiswabelajar = $id;
            if($i==0){
                $bayar->tanggal = $tglsekarang;
            }
            else{
                $generate = strtotime("+".$bulanadd." month", strtotime($tglsekarang));
                $tglnyaaa = date("Y-m-d H:i:s", $generate);
                $bayar->tanggal = $tglnyaaa;
            }
            $bayar->save();
            $bulanadd++;
        }

        //untuk input ke rapot kursus
        foreach ($carijadwal as $key) 
        {
            $plus = 7;
            for($i=0; $i<ceil($cariprogra['jmlpertemuan']/$itungjadwal); $i++)
            {
                $jadwalgenerate = new Jadwalgenerate();

                if($i == 0) {
                    $jadwalgenerate->tanggal         = $key['tanggal'];
                } else {
                    $generate = strtotime("+".$plus." day", strtotime($key['tanggal']));
                    $tglnyaaa = date("Y-m-d", $generate);
                    $plus += 7;
                    
                    $jadwalgenerate->tanggal         = $tglnyaaa;
                }

                $jadwalgenerate->idsiswabelajar         = $carisispro->idsiswabelajar;
                $jadwalgenerate->idguru                 = $key->idguru;
                $jadwalgenerate->hari                   = $key->hari;
                $jadwalgenerate->jam                    = $key->jam;
                //$jadwalgenerate->statusrapotkursus      = 'B';
                $jadwalgenerate->save();
            }
        }

        return $this->redirect(['informasikursus', 'id'=>$carisispro->idsiswabelajar]);
    }

    public function actionHapusgenerate($id)
    {
        Jadwalgenerate::deleteAll(['idsiswabelajar'=>$id]);

        return $this->redirect(['informasikursus', 'id'=>$id]);
    }

    public static function tglIndo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
}

