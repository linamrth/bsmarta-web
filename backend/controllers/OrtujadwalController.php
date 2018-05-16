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
use backend\models\Trial;
use backend\models\Program;
use backend\models\Jadwal;
use backend\models\Jadwalgenerate;
use backend\models\Guru;
use backend\models\Rapottrial;
use backend\models\RapottrialcintabacaForm;
use backend\models\RapottrialcintamatikaForm;

class OrtujadwalController extends \yii\web\Controller
{
    public function actionIndexjadwaltrial()
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

        return $this->render('indexjadwaltrial', ['result' => $result]);
    }

    public function actionJadwaltrial($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.*, program.namaprogram, guru.namaguru, jadwal.hari, jadwal.jam, jadwal.tanggal
            FROM jadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN program ON trial.idprogram = program.idprogram
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            WHERE jadwal.idtrial = '".$id."'");

        $result = $command->queryAll();
        
        return $this->render('jadwaltrial', ['result'=>$result]);
    }

    public function actionIndexjadwalkursus()
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

        return $this->render('indexjadwalkursus', ['result' => $result]);
    }

    public function actionJadwalkursus($id)
    {
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$id])->one();
        $jadwal = Jadwal::find()->where(['idsiswabelajar'=>$id])->all();
        $jadwalgenerate = Jadwalgenerate::find()->where(['idsiswabelajar'=>$id])->orderBy(['tanggal'=>SORT_ASC])->all();
        
        return $this->render('jadwalkursus', [
            'siswabelajar'=>$siswabelajar,
            'jadwal'=>$jadwal,
            'jadwalgenerate'=>$jadwalgenerate
        ]);
    }
}
