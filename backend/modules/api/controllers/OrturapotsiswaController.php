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
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, guru.namaguru, rapottrial.tgl, rapottrial.soal1, rapottrial.soal2, rapottrial.soal3, rapottrial.soal4, rapottrial.soal5, rapottrial.soal6, rapottrial.soal7, rapottrial.soal8, rapottrial.soal9, rapottrial.soal10, rapottrial.soal11, rapottrial.catatan
            FROM rapottrial
            INNER JOIN jadwal ON rapottrial.idjadwal = jadwal.idjadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN program ON trial.idprogram = program.idprogram
            WHERE trial.idtrial = '".$id."'");
        $rapottrial = $command->queryAll();

        $hasil['namalengkap']           = $rapottrial[0]['namalengkap'];
        $hasil['kelas']                 = $rapottrial[0]['kelas'];
        $hasil['namaprogram']           = $rapottrial[0]['namaprogram'];
        $hasil['namaguru']              = $rapottrial[0]['namaguru'];
        $hasil['tgl']                   = $rapottrial[0]['tgl'];
        $hasil['soal1']                 = $rapottrial[0]['soal1'];
        $hasil['soal2']                 = $rapottrial[0]['soal2'];
        $hasil['soal3']                 = $rapottrial[0]['soal3'];
        $hasil['soal4']                 = $rapottrial[0]['soal4'];
        $hasil['soal5']                 = $rapottrial[0]['soal5'];
        $hasil['soal6']                 = $rapottrial[0]['soal6'];
        $hasil['soal7']                 = $rapottrial[0]['soal7'];
        $hasil['soal8']                 = $rapottrial[0]['soal8'];
        $hasil['soal9']                 = $rapottrial[0]['soal9'];
        $hasil['soal10']                = $rapottrial[0]['soal10'];
        $hasil['soal11']                = $rapottrial[0]['soal11'];
        $hasil['catatan']               = $rapottrial[0]['catatan'];

        return $hasil;
    }

    public function actionIndexrapotkursus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
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
            SELECT jadwalgenerate.hari, jadwalgenerate.tanggal, jadwalgenerate.statusrapotkursus, guru.namaguru, jadwalgenerate.idgenerate
            FROM jadwalgenerate
            INNER JOIN guru ON jadwalgenerate.idguru = guru.idguru
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            WHERE siswabelajar.idsiswabelajar = '".$id."' 
            ORDER BY jadwalgenerate.tanggal");
        $jadwalgenerate = $command->queryAll();

        return ['status'=>'OK', 'jadwalgenerate'=>$jadwalgenerate];
    }

    public function actionRapotkursus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, guru.namaguru, rapotbelajar.tanggal, rapotbelajar.pertemuanke, rapotbelajar.materi, rapotbelajar.halamanketercapaian, rapotbelajar.hasil, rapotbelajar.catatanguru, rapotbelajar.rewardhasil, rapotbelajar.rewardsikap, siswabelajar.idsiswabelajar
            FROM rapotbelajar
            INNER JOIN guru ON rapotbelajar.idguru = guru.idguru
            INNER JOIN jadwalgenerate ON rapotbelajar.idgenerate = jadwalgenerate.idgenerate
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE jadwalgenerate.idgenerate = '".$id."'");
        $rapotkursus = $command->queryAll();

        $hasil['namalengkap']               = $rapotkursus[0]['namalengkap'];
        $hasil['kelas']                     = $rapotkursus[0]['kelas'];
        $hasil['namaprogram']               = $rapotkursus[0]['namaprogram'];
        $hasil['level']                     = $rapotkursus[0]['level'];
        $hasil['namaguru']                  = $rapotkursus[0]['namaguru'];
        $hasil['tanggal']                   = $rapotkursus[0]['tanggal'];
        $hasil['pertemuanke']               = $rapotkursus[0]['pertemuanke'];
        $hasil['materi']                    = $rapotkursus[0]['materi'];
        $hasil['halamanketercapaian']       = $rapotkursus[0]['halamanketercapaian'];
        $hasil['hasil']                     = $rapotkursus[0]['hasil'];
        $hasil['catatanguru']               = $rapotkursus[0]['catatanguru'];
        $hasil['rewardhasil']               = $rapotkursus[0]['rewardhasil'];
        $hasil['rewardsikap']               = $rapotkursus[0]['rewardsikap'];

        return $hasil;
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