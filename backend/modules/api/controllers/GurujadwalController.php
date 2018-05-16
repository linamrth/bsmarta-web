<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class GurujadwalController extends Controller
{
    public function actionIndex($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT jadwal.hari, jadwal.tanggal, jadwal.jam, siswa.namalengkap, program.namaprogram, programlevel.level, jadwal.statusjadwal
			FROM jadwal
			INNER JOIN siswabelajar ON jadwal.idsiswabelajar = siswabelajar.idsiswabelajar
			INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
			INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
			INNER JOIN program ON programlevel.idprogram = program.idprogram
			WHERE jadwal.idguru = '".$id."'
			AND jadwal.statusjadwal = 'K' 
			ORDER BY jadwal.tanggal ");

        $result = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }
}
