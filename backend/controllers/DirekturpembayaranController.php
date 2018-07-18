<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;
use yii\base\DynamicModel;

use backend\models\Pembayaran;
use backend\models\Siswabelajar;

class DirekturpembayaranController extends \yii\web\Controller
{
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
            SELECT siswa.namalengkap, siswabelajar.*, pembayaran.*
            FROM pembayaran
            LEFT JOIN siswabelajar ON pembayaran.idsiswabelajar = siswabelajar.idsiswabelajar
            LEFT JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            WHERE siswabelajar.idsiswabelajar = '".$id."'");

        $result = $command->queryAll();
        
        return $this->render('detailpembayaran', ['result'=>$result]);
    }

    public function actionPembayaranglobal()
    {
        $model = new DynamicModel(['tahun', 'bulan']);
        $model->addRule(['tahun'], 'string');
        $model->addRule(['tahun'], 'required');
        $model->addRule(['bulan'], 'string');
        $model->addRule(['bulan'], 'required');

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $tanggal = $model['tahun'].'-'.$model['bulan'];
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT siswa.namalengkap, program.namaprogram, programlevel.level, pembayaran.tanggal, pembayaran.statuspembayaran
                FROM pembayaran
                INNER JOIN siswabelajar ON pembayaran.idsiswabelajar = siswabelajar.idsiswabelajar
                INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
                INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
                INNER JOIN program ON programlevel.idprogram = program.idprogram
                WHERE pembayaran.statuspembayaran = 'S' AND tanggal LIKE '".$tanggal."%'");
            $result = $command->queryAll();

            return $this->render('pembayaranglobal', [
                'model'=>$model, 
                'result'=>$result, 
                'tahun'=>$this->getTahun(), 
                'bulan'=>$this->getBulan()
            ]);
        } 
        else{
            $model->tahun = '';
            $model->bulan = '';
            return $this->render('pembayaranglobal', [
                'model'=>$model, 
                'result'=>[], 
                'tahun'=>$this->getTahun(), 
                'bulan'=>$this->getBulan()
            ]);
        }
    }

    protected function getBulan()
    {
        $bulan = [
            '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
            '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',
        ];

        return $bulan;
    }

    protected function getTahun() 
    {
        $currentYear = date('Y');
        $yearFrom = date('Y')-10;
        $yearsRange = range($yearFrom, $currentYear);
        return array_combine($yearsRange, $yearsRange);
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
