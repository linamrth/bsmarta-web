<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Lessonplan;

class OrturapotsiswaController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndexrapottrial($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, trial.idtrial
            FROM trial
            INNER JOIN program ON trial.idprogram = program.idprogram
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            WHERE orangtua.idorangtua = '".$id."'
            ORDER BY siswa.namalengkap");
        $result = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionRapottrial($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, guru.namaguru, rapottrial.tgl
            FROM rapottrial
            INNER JOIN jadwal ON rapottrial.idjadwal = jadwal.idjadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN program ON trial.idprogram = program.idprogram
            WHERE trial.idtrial = '".$id."'");
        $siswatrial = $command->queryAll();

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT rapottrial.soal1, rapottrial.soal2, rapottrial.soal3, rapottrial.soal4, rapottrial.soal5, rapottrial.soal6, rapottrial.soal7, rapottrial.soal8, rapottrial.soal9, rapottrial.soal10, rapottrial.soal11, rapottrial.catatan
            FROM rapottrial
            INNER JOIN jadwal ON rapottrial.idjadwal = jadwal.idjadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            WHERE trial.idtrial = '".$id."'");
        $rapottrial = $command->queryAll();

        return ['status'=>'OK', 'siswatrial'=>$siswatrial, 'rapottrial'=>$rapottrial];
    }

    public function actionIndexrapotkursus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level
            FROM siswabelajar
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            WHERE orangtua.idorangtua = '".$id."'
            ORDER BY siswa.namalengkap");
        $result = $command->queryAll();

        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionViewrapotkursus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, program.namaprogram, programlevel.level
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE siswabelajar.idsiswabelajar = '".$id."'");
        $result = $command->queryAll();

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT jadwalgenerate.hari, jadwalgenerate.tanggal, guru.namaguru
            FROM jadwalgenerate
            INNER JOIN guru ON jadwalgenerate.idguru = guru.idguru
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            WHERE siswabelajar.idsiswabelajar = '".$id."' 
            ORDER BY jadwalgenerate.tanggal");
        $jadwalgenerate = $command->queryAll();

        return ['status'=>'OK', 'result'=>$result, 'jadwalgenerate'=>$jadwalgenerate];
    }

    public function actionRapotkursus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, program.namaprogram, programlevel.level, guru.namaguru, jadwalgenerate.tanggal, rapotbelajar.pertemuanke, rapotbelajar.materi, rapotbelajar.halamanketercapaian, rapotbelajar.hasil, rapotbelajar.catatanguru, rapotbelajar.rewardhasil, rapotbelajar.rewardsikap, siswabelajar.idsiswabelajar
            FROM rapotbelajar
            INNER JOIN guru ON rapotbelajar.idguru = guru.idguru
            INNER JOIN jadwalgenerate ON rapotbelajar.idgenerate = jadwalgenerate.idgenerate
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE jadwalgenerate.idgenerate = '".$id."'");
        $result = $command->queryAll();

        return ['status'=>'OK', 'result'=>$result];
    }

    public function actionGrafikperkembangan($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

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

        return ['status'=>'OK', 'pertemuan'=>$pertemuan, 'target'=>$target, 'hasiltarget'=>$hasiltarget];
    }
}