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

class OrturapotsiswaController extends \yii\web\Controller
{
    public function actionIndexrapottrial()
    {
        $ambilidortu = Yii::$app->user->identity->idorangtua;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, program.namaprogram, trial.idtrial
            FROM trial
            INNER JOIN program ON trial.idprogram = program.idprogram
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            WHERE orangtua.idorangtua = $ambilidortu
            ORDER BY siswa.namalengkap");
        $result = $command->queryAll();

        return $this->render('indexrapottrial', ['result' => $result]);
    }

    public function actionRapottrial($id)
    {
    	$ambilidortu = Yii::$app->user->identity->idorangtua;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, program.*, guru.namaguru, rapottrial.*, trial.idtrial
			FROM rapottrial
			INNER JOIN jadwal ON rapottrial.idjadwal = jadwal.idjadwal
			INNER JOIN trial ON jadwal.idtrial = trial.idtrial
			INNER JOIN guru ON jadwal.idguru = guru.idguru
			INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
			INNER JOIN program ON trial.idprogram = program.idprogram
			WHERE trial.idtrial = '".$id."'");
        $result = $command->queryAll();

        return $this->render('rapottrial', ['result' => $result]);
    }

    public function actionIndexrapotkursus()
    {
    	$ambilidortu = Yii::$app->user->identity->idorangtua;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
            FROM siswabelajar
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            WHERE orangtua.idorangtua = $ambilidortu
            ORDER BY siswa.namalengkap");
        $result = $command->queryAll();

        return $this->render('indexrapotkursus', ['result' => $result]);
    }

    public function actionViewrapotkursus($id)
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
        
        return $this->render('viewrapotkursus', [
            'result'=>$result,
            'jadwalgenerate'=>$jadwalgenerate,
        ]);
    }

    public function actionRapotkursus($id)
    {
        $rapot = Rapotbelajar::find()->where(['idgenerate'=>$id])->one();
        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$rapot->idgenerate])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $siswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $program = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();

        return $this->render('rapotkursus', [
            'rapot'=>$rapot,
            'siswabelajar'=>$siswabelajar,
            'siswa'=>$siswa,
            'lvprogram'=>$lvprogram,
            'program'=>$program,
            'back'=>$siswabelajar->idsiswabelajar
        ]);
    }

    public function actionGrafikperkembangan($id)
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

        return $this->render('grafikperkembangan', [
            'pertemuan'=>$pertemuan, 
            'target'=>$target,
            'hasiltarget'=>$hasiltarget,
            'back'=>$result[0]['idsiswabelajar'],
        ]);
    }
}
