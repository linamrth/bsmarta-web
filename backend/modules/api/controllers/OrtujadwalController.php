<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Siswabelajar;
use backend\models\Jadwal;
use backend\models\Jadwalgenerate;

class OrtujadwalController extends Controller
{
	public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndexjadwaltrial($id)
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

        return ['status'=>'OK', 'result'=>$result];
    }

    public function actionJadwaltrial($id)
    {
    	Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, siswa.asalsekolah, program.namaprogram, guru.namaguru, jadwal.hari, jadwal.jam, jadwal.tanggal
            FROM jadwal
            INNER JOIN trial ON jadwal.idtrial = trial.idtrial
            INNER JOIN siswa ON trial.idsiswa = siswa.idsiswa
            INNER JOIN program ON trial.idprogram = program.idprogram
            INNER JOIN guru ON jadwal.idguru = guru.idguru
            WHERE jadwal.idtrial = '".$id."'");

        $result = $command->queryAll();

        $terserah['namalengkap']        = $result[0]['namalengkap'];
        $terserah['kelas']              = $result[0]['kelas'];
        $terserah['asalsekolah']        = $result[0]['asalsekolah'];
        $terserah['namaprogram']        = $result[0]['namaprogram'];
        $terserah['namaguru']           = $result[0]['namaguru'];
        $terserah['hari']               = $result[0]['hari'];
        $terserah['tanggal']            = $result[0]['tanggal'];
        $terserah['jam']                = $result[0]['jam'];
        
        return $terserah;
    }

    public function actionIndexjadwalkursus($id)
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

        return ['status'=>'OK', 'result' => $result];
    }

    public function actionJadwalkursus($id)
    {
    	Yii::$app->response->format = Response::FORMAT_JSON;

    	$connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level
			FROM siswabelajar
			INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
			INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
			INNER JOIN program ON programlevel.idprogram = program.idprogram
			WHERE siswabelajar.idsiswabelajar = '".$id."'");
        $siswabelajar = $command->queryAll();

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT guru.namaguru, jadwalgenerate.hari, jadwalgenerate.tanggal, jadwalgenerate.jam
			FROM jadwalgenerate
			INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
			INNER JOIN guru ON jadwalgenerate.idguru = guru.idguru
			WHERE siswabelajar.idsiswabelajar = '".$id."'
			ORDER BY jadwalgenerate.tanggal");
        $jadwalgenerate = $command->queryAll();
        
        return ['status'=>'OK', 'siswabelajar'=>$siswabelajar, 'jadwalgenerate'=>$jadwalgenerate];
    }
}
