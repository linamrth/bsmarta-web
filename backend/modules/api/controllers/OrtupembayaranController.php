<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class OrtupembayaranController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE orangtua.idorangtua = '".$id."'
            ORDER BY siswa.namalengkap");
        $result = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionDetailpembayaran($id)
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
            SELECT pembayaran.tanggal, pembayaran.statuspembayaran
            FROM pembayaran
            LEFT JOIN siswabelajar ON pembayaran.idsiswabelajar = siswabelajar.idsiswabelajar
            LEFT JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            WHERE siswabelajar.idsiswabelajar = '".$id."'");

        $pembayaran = $command->queryAll();
        
        return ['status'=>'OK', 'siswabelajar'=>$siswabelajar, 'pembayaran'=>$pembayaran];
    }
}