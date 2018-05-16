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
use backend\models\SiswaForm;
use backend\models\Trial;
use backend\models\Program;
use backend\models\Jadwal;
use backend\models\JadwaltrialForm;
use backend\models\Guru;
use backend\models\Rapottrial;
use backend\models\RapottrialcintabacaForm;
use backend\models\RapottrialcintamatikaForm;
use backend\models\User;
use backend\models\UserForm;

class AdmintrialController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $ortu = Orangtua::find()->orderBy(['namaortu' => SORT_ASC])->all();
        return $this->render('index', ['ortus'=>$ortu]);
    }

    public function actionView($id)
    {
        $ortu = Orangtua::find()->where(['idorangtua'=>$id])->one();
        $siswa = Siswa::find()->where(['idorangtua'=>$ortu->idorangtua])
                    ->orderBy(['namalengkap' => SORT_ASC])
                    ->all();
        return $this->render('view', ['ortus' => $ortu, 'siswas'=>$siswa]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idorangtua]);
        } else {
            return $this->render('updatedaftarortu', ['model' => $model]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Orangtua::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDaftarortu()
    {
    	$model = new Orangtua();

        if ($model->load(Yii::$app->request->post())) {
        	$model->save();
            return $this->redirect(['index', 'id'=>$model->idorangtua]);
        }
        else{
            return $this->render('daftarortu', ['model' => $model]);
        }
    }

    public function actionFormuserortu($id)
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->idcabang    = Yii::$app->user->identity->idcabang;
            $model->idorangtua  = $id;
            $model->level       = "4";
            $model->daftarUserortu();
            return $this->redirect(['adminuser/index']);
        }
        else{
            return $this->render('formuserortu', ['model' => $model]);
        }
    }

    public function actionDaftarsiswa($id)
    {
        $model = new SiswaForm();
        $tabel = new Siswa();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {        
            $tabel->idcabang       = $model->idcabang;
            $tabel->idorangtua     = $model->idorangtua;
            $tabel->namalengkap    = $model->namalengkap;
            $tabel->namapanggilan  = $model->namapanggilan;
            $tabel->alamat         = $model->alamat;
            $tabel->tempatlahir    = $model->tempatlahir;
            $tabel->tgllahir       = $model->tgllahir;
            $tabel->asalsekolah    = $model->asalsekolah;
            $tabel->kelas          = $model->kelas;
            $tabel->keterangan     = $model->keterangan;
            $tabel->tgldaftar      = date('Y-m-d');

            if($tabel->save())
            {
                return $this->redirect(['view', 'id'=>$model->idorangtua]);
            }
        }
        else
        {
            $model->idorangtua = $id;
            return $this->render('daftarsiswa', ['model' => $model]);
        }
    }

    public function actionDaftarprogramtrial($id){
        $model = new Trial();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['jadwaltrial', 'id'=>$model->idtrial]);
        }
        else{
            $model->idsiswa = $id;
            return $this->render('daftarprogramtrial', ['model' => $model]);
        }
    }

    public function actionJadwaltrial($id)
    {
        $gettrial = Trial::find()->where(['idtrial'=>$id])->one();
        $getsiswa = Siswa::find()->where(['idsiswa'=>$gettrial->idsiswa])->one();
        $getortu  = Orangtua::find()->where(['idorangtua'=>$getsiswa->idorangtua])->one();
        $getprogram = Program::find()->where(['idprogram'=>$gettrial->idprogram])->one();

        $tabel = new Jadwal();
        $model = new JadwaltrialForm();

        if($model->load(Yii::$app->request->post())){
            $tabel->idsiswabelajar  = 0;
            $tabel->idguru          = $model->idguru;
            $tabel->hari            = $model->hari;
            $tabel->tanggal         = $model->tanggal;
            $tabel->jam             = $model->jam;
            $tabel->idtrial         = $gettrial->idtrial;
            $tabel->statusjadwal    = 'T';
            $tabel->save();

            $gettrial->status = 'K';
            $gettrial->save();

            $getsiswa->statussiswa = 'T';
            $getsiswa->save();

            return $this->redirect(['siswatrial']);
        }
        else{
            return $this->render('jadwaltrial', [
                'trial'=>$gettrial,
                'siswa'=>$getsiswa,
                'ortu'=>$getortu,
                'program'=>$getprogram,
                'model'=>$model
            ]);
        }
    }

    public function actionSiswatrial()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, guru.namaguru, jadwal.idjadwal, trial.status, program.idprogram
            FROM jadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN program ON trial.idprogram = program.idprogram
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            WHERE jadwal.statusjadwal = 'T'
            OR jadwal.statusjadwal = 'U'
            ORDER BY siswa.namalengkap");

        $jadwal = $command->queryAll();
        
        return $this->render('siswatrial', ['jadwals'=>$jadwal]);

        // $jadwal = Jadwal::find()->where(['statusjadwal'=>'T'])->orWhere(['statusjadwal'=>'U'])->orderBy(['idjadwal' => SORT_ASC])->all();
        // return $this->render('siswatrial', ['jadwals'=>$jadwal]);
    }

    public function actionInformasitrial($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, program.namaprogram, guru.namaguru, jadwal.hari, jadwal.jam, jadwal.tanggal
            FROM jadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN program ON trial.idprogram = program.idprogram
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            WHERE jadwal.idjadwal = '".$id."'");

        $result = $command->queryAll();
        
        return $this->render('informasitrial', ['result'=>$result]);
    }

    public function actionCintabacaform($id)
    {
        $getjadwal = Jadwal::find()->where(['idjadwal'=>$id])->one();
        $gettrial  = Trial::find()->where(['idtrial'=>$getjadwal->idtrial])->one();
        $getsiswa  = Siswa::find()->where(['idsiswa'=>$gettrial->idsiswa])->one();
        $getortu   = Orangtua::find()->where(['idorangtua'=>$getsiswa->idorangtua])->one();
        $getprogram = Program::find()->where(['idprogram'=>$gettrial->idprogram])->one();
        $getguru    = Guru::find()->where(['idguru'=>$getjadwal->idguru])->one();

        $tabel      = new Rapottrial();
        $model      = new RapottrialcintabacaForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            //insert data trial hasil
            $tabel->idjadwal = $id;
            $tabel->soal1 = $model->soal1;
            $tabel->soal2 = $model->soal2;
            $tabel->soal3 = $model->soal3;
            $tabel->soal4 = $model->soal4;
            $tabel->soal5 = $model->soal5;
            $tabel->soal6 = $model->soal6;
            $tabel->soal7 = $model->soal7;
            $tabel->soal8 = $model->soal8;
            $tabel->soal9 = $model->soal9;
            $tabel->soal10 = $model->soal10;
            $tabel->soal11 = $model->soal11;
            $tabel->catatan = $model->catatan;
            $tabel->tgl = date('Y-m-d H:i:s');
            $tabel->save();

            //update tabel status trial
            $gettrial->status = 'Y';
            $gettrial->save();

            //update tabel status siswa
            $getsiswa->statussiswa = 'M';
            $getsiswa->save();
            
            return $this->redirect(['siswatrial']);
        }
        else{
            return $this->render('cintabacaform', [
                'jadwal'=>$getjadwal,
                'trial'=>$gettrial,
                'siswa'=>$getsiswa,
                'ortu'=>$getortu,
                'program'=>$getprogram,
                'guru'=>$getguru,
                'model'=>$model
            ]);
        }
    }

    public function actionCintamatikaform($id)
    {
        $getjadwal = Jadwal::find()->where(['idjadwal'=>$id])->one();
        $gettrial  = Trial::find()->where(['idtrial'=>$getjadwal->idtrial])->one();
        $getsiswa  = Siswa::find()->where(['idsiswa'=>$gettrial->idsiswa])->one();
        $getortu   = Orangtua::find()->where(['idorangtua'=>$getsiswa->idorangtua])->one();
        $getprogram = Program::find()->where(['idprogram'=>$gettrial->idprogram])->one();
        $getguru    = Guru::find()->where(['idguru'=>$getjadwal->idguru])->one();

        $tabel      = new Rapottrial();
        $model      = new RapottrialcintamatikaForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            //insert data trial hasil
            $tabel->idjadwal = $id;
            $tabel->soal1 = $model->soal1;
            $tabel->soal2 = $model->soal2;
            $tabel->soal3 = $model->soal3;
            $tabel->soal4 = $model->soal4;
            $tabel->soal5 = $model->soal5;
            $tabel->soal6 = $model->soal6;
            $tabel->soal7 = $model->soal7;
            $tabel->soal8 = $model->soal8;
            $tabel->catatan = $model->catatan;
            $tabel->tgl = date('Y-m-d H:i:s');
            $tabel->save();

            //update tabel status trial
            $gettrial->status = 'Y';
            $gettrial->save();

            //update tabel status siswa
            $getsiswa->statussiswa = 'M';
            $getsiswa->save();
            
            return $this->redirect(['siswatrial']);
        }
        else{
            return $this->render('cintamatikaform', [
                'jadwal'=>$getjadwal,
                'trial'=>$gettrial,
                'siswa'=>$getsiswa,
                'ortu'=>$getortu,
                'program'=>$getprogram,
                'guru'=>$getguru,
                'model'=>$model
            ]);
        }
    }

    public function actionRapottrial($id)
    {
        $getjadwal = Jadwal::find()->where(['idjadwal'=>$id])->one();
        $gettrial  = Trial::find()->where(['idtrial'=>$getjadwal->idtrial])->one();
        $getsiswa  = Siswa::find()->where(['idsiswa'=>$gettrial->idsiswa])->one();
        $getortu   = Orangtua::find()->where(['idorangtua'=>$getsiswa->idorangtua])->one();
        $getprogram = Program::find()->where(['idprogram'=>$gettrial->idprogram])->one();
        $getguru    = Guru::find()->where(['idguru'=>$getjadwal->idguru])->one();

        $model  = Rapottrial::findOne(['idjadwal'=>$id]);

        return $this->render('rapottrial', [
                'jadwal'=>$getjadwal,
                'trial'=>$gettrial,
                'siswa'=>$getsiswa,
                'ortu'=>$getortu,
                'program'=>$getprogram,
                'guru'=>$getguru,
                'model'=>$model
            ]);
    }

    public function listJeniskelamin($isi)
    {
        $jeniskelamin = ["L"=>"Laki-laki", "P"=>"Perempuan"];
        return $jeniskelamin[$isi];
    }
}
