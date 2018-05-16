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
use backend\models\Trial;
use backend\models\Program;
use backend\models\Jadwal;
use backend\models\JadwaltrialForm;
use backend\models\Guru;
use backend\models\Rapottrial;
use backend\models\RapottrialcintabacaForm;
use backend\models\RapottrialcintamatikaForm;
use backend\models\Siswabelajar;
use backend\models\Programlevel;
use backend\models\Jadwalgenerate;
use backend\models\Rapotbelajar;
use backend\models\RapotbelajarForm;
use backend\models\Lessonplan;

class DirekturrapotsiswaController extends \yii\web\Controller
{
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

    public function actionAllsiswa()
    {
        $siswabelajar = Siswabelajar::find()
            ->select('siswabelajar.*, jadwal.*')
            ->rightJoin('jadwal', 'jadwal.idsiswabelajar = siswabelajar.idsiswabelajar')
            ->leftJoin('programlevel', 'programlevel.idprogramlevel = siswabelajar.idprogramlevel')
            ->leftJoin('siswa', 'siswa.idsiswa = siswabelajar.idsiswa')
            ->where([
                'siswabelajar.idcabang'=>Yii::$app->user->identity->idcabang,
                ])
            ->orderBy('siswa.namalengkap')
            ->asArray()
            ->all();

        return $this->render('allsiswa', ['siswabelajar'=>$siswabelajar]);
    }

    public function actionAllsiswaview($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, siswabelajar.*, jadwal.*, programlevel.level, program.namaprogram
            FROM siswabelajar
            RIGHT JOIN jadwal ON jadwal.idsiswabelajar = siswabelajar.idsiswabelajar
            LEFT JOIN programlevel ON programlevel.idprogramlevel = siswabelajar.idprogramlevel
            LEFT JOIN program ON program.idprogram = programlevel.idprogram
            LEFT JOIN siswa ON siswa.idsiswa = siswabelajar.idsiswa
            WHERE siswabelajar.idsiswabelajar = '".$id."'");
        $result = $command->queryAll();

        $jadwalgenerate = Jadwalgenerate::find()->where(['idsiswabelajar'=>$id])->orderBy(['tanggal'=>SORT_ASC])->all();
        
        return $this->render('allsiswaview', [
            'result'=>$result,
            'jadwalgenerate'=>$jadwalgenerate,
        ]);
    }

    public function actionAllsiswalihatrapot($id)
    {
        $rapot = Rapotbelajar::find()->where(['idgenerate'=>$id])->one();
        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$rapot->idgenerate])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $siswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $program = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();

        return $this->render('allsiswalihatrapot', [
            'rapot'=>$rapot,
            'siswabelajar'=>$siswabelajar,
            'siswa'=>$siswa,
            'lvprogram'=>$lvprogram,
            'program'=>$program,
            'back'=>$siswabelajar->idsiswabelajar
        ]);
    }

    public function actionAllsiswagrafikperkembangan($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswabelajar.*, jadwalgenerate.*, rapotbelajar.*, programlevel.idprogramlevel
            FROM rapotbelajar
            INNER JOIN jadwalgenerate ON rapotbelajar.idgenerate = jadwalgenerate.idgenerate
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            WHERE siswabelajar.idsiswabelajar = '".$id."'
            ORDER BY rapotbelajar.tanggal");
        $result = $command->queryAll();
        
        $hasiltarget = array();
        foreach ($result as $key) {
            array_push($hasiltarget, $key['halamanketercapaian']);
        }

        $data = Lessonplan::find()->where(['idprogramlevel'=>$result[0]['idprogramlevel']])->all();
        $pertemuan = array();
        $target = array();
        foreach ($data as $key) {
            array_push($pertemuan, $key['pertemuan']);
            array_push($target, $key['hal']);
        }

        return $this->render('allsiswagrafikperkembangan', [
            'pertemuan'=>$pertemuan, 
            'target'=>$target,
            'hasiltarget'=>$hasiltarget,
            'back'=>$result[0]['idsiswabelajar'],
        ]);
    }
}
