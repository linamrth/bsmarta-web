<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;

use backend\models\Program;
use backend\models\Pembayaran;
use backend\models\Siswabelajar;

class AdminpembayaranController extends \yii\web\Controller
{

    public function actionReportpembayaran(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
        
        $Pembayaran = Program::findOne(['idprogram'=>'1']);
        
        $content = $this->renderPartial('_reportView', [
            'program' => $Pembayaran
        ]);
        
        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        
        return $pdf->render(); 
    }

    public function actionIndex()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar, orangtua.namaortu
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            ORDER BY siswa.namalengkap");

        $result = $command->queryAll();
        
        return $this->render('index', ['result'=>$result]);
    }

    public function actionDetailpembayaran($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, program.namaprogram, programlevel.level, program.biayakursus, siswabelajar.*, pembayaran.*
            FROM pembayaran
            LEFT JOIN siswabelajar ON pembayaran.idsiswabelajar = siswabelajar.idsiswabelajar
            LEFT JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE siswabelajar.idsiswabelajar = '".$id."'");

        $result = $command->queryAll();
        
        return $this->render('detailpembayaran', ['result'=>$result]);
    }

    public function actionChecklist($id)
    {
        $model = $this->findModel($id);
        $model->statuspembayaran='S';

        if($model->save()){
            // return $this->redirect(['detailpembayaran', 'id'=>$model['idsiswabelajar']]);
            return $this->redirect(['reportpembayaran']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Pembayaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function tglIndo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
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
