<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Jadwal;
use backend\models\Trial;
use backend\models\Siswa;
use backend\models\Siswabelajar;
use backend\models\Program;
use backend\models\Programlevel;
use backend\models\Guru;
/**
 * Default controller for the `api` module
 */
class GurujadwalController extends Controller
{
    public function actionIndex($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $pecah = explode("_", $id);

        $hari = [
            'Senin'=>'Senin', 'Selasa'=>'Selasa', 'Rabu'=>'Rabu', 
            'Kamis'=>'Kamis', 'Jumat'=>'Jumat', 'Sabtu'=>'Sabtu'
        ];

        $jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];


        foreach ($jam as $key => $value) {

            $senin  = Jadwal::find()
                    ->where(['jam'=>$key, 'hari'=>$pecah[1], 'idguru'=>$pecah[0]])
                    ->all();
            $msenin = Jadwal::find()
                    ->where(['jam'=>$key, 'hari'=>$pecah[1], 'idguru'=>$pecah[0]])
                    ->count();

            $result['Hari'] = $pecah[1];
            foreach ($senin as $key2) {

                $jadwal = Jadwal::find()->where(['idjadwal'=>$key2->idjadwal])->one();

                $trial = Trial::find()->where(['idtrial'=>$jadwal['idtrial']])->one();
                $nmsiswt = Siswa::find()->where(['idsiswa'=>$trial['idsiswa']])->one();

                $prog = Program::find()->where(['idprogram'=>$trial['idprogram']])->one();
                $nmprogt = Program::find()->where(['idprogram'=>$prog['idprogram']])->one();

                $siprog = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwal['idsiswabelajar']])->one();
                $nmsiswk = Siswa::find()->where(['idsiswa'=>$siprog['idsiswa']])->one();
                
                $lvprog = Programlevel::find()->where(['idprogramlevel'=>$siprog['idprogramlevel']])->one();
                $nmprogk = Program::find()->where(['idprogram'=>$lvprog['idprogram']])->one();

               //  if($key2['statusjadwal'] === 'T') {
               //      $jam['Jam'][] = $value;
               //      $jadwal['Jadwal'][] = $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')';
               //  } 
               // elseif($key2['statusjadwal'] === 'K'){
               //      $jam['Jam'][] = $value;
               //      $jadwal['Jadwal'][] = $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')';
               // }
                
                if($key2['statusjadwal'] === 'T') {
                    $result['Jam'][] = $value;
                    $result['Jadwal'][] = $nmsiswt['namapanggilan'].' - '.$nmprogt['namaprogram'].' ('.$jadwal['statusjadwal'].')';
                } 
               elseif($key2['statusjadwal'] === 'K'){
                $result['Jam'][] = $value;
                    $result['Jadwal'][] = $nmsiswk['namapanggilan'].' - '.$nmprogk['namaprogram'].' '.$lvprog['level'].' ('.$jadwal['statusjadwal'].')';
               }
            }
        }
        
        return ['status'=>'OK', 'results'=>$result];
        //return ['status'=>'OK', 'jam'=>$jam, 'jadwal'=>$jadwal ];
    }
}
