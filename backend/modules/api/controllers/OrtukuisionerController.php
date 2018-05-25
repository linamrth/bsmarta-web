<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Kuisioner;
use backend\models\KuisionerForm;

class OrtukuisionerController extends Controller
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

    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT kuisioner.tanggal, guru.namaguru, kuisioner.statuskuisioner, kuisioner.idkuisioner
            FROM kuisioner
            INNER JOIN siswabelajar ON kuisioner.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN guru ON kuisioner.idguru = guru.idguru
            WHERE kuisioner.idsiswabelajar = '".$id."'");
        $result = $command->queryAll();

        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionInputkuisioner($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, program.namaprogram, programlevel.level, guru.namaguru, kuisioner.idkuisioner, kuisioner.idsiswabelajar, kuisioner.statuskuisioner
            FROM kuisioner
            INNER JOIN siswabelajar ON kuisioner.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            INNER JOIN guru ON kuisioner.idguru = guru.idguru
            WHERE kuisioner.idkuisioner = '".$id."'");
        $result = $command->queryAll();

        if(Yii::$app->request->post()){
            $model = Yii::$app->request->post();
            // $model = new KuisionerForm();
            // $tabel = Kuisioner::find()->Where(['idkuisioner'=>$id])->one();
            $tabel = new Kuisioner();
            $tabel = Kuisioner::find()->Where(['idkuisioner'=>$id])->one();
            $tabel->penguasaanmateri            = $model['penguasaanmateri'];
            $tabel->kemampuanmengajar           = $model['kemampuanmengajar'];
            $tabel->kedisiplinan                = $model['kedisiplinan'];
            $tabel->tanggungjawabdantingkahlaku = $model['tanggungjawabdantingkahlaku'];
            $tabel->kerjasama                   = $model['kerjasama'];
            $tabel->statuskuisioner             = 'S';

            if($tabel->save())
            {
                return ['status'=>'Sudah Terisi !', 'result'=>$tabel];
            } else{
                return ['status'=>'Belum Terisi !'];   
            }

        } else {
            return ['status'=>'OK'];
        }
    }

    public function actionLihatkuisioner($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT guru.namaguru, siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, kuisioner.tanggal, kuisioner.penguasaanmateri, kuisioner.kemampuanmengajar, kuisioner.kedisiplinan, kuisioner.tanggungjawabdantingkahlaku, kuisioner.kerjasama, siswabelajar.idsiswabelajar
            FROM kuisioner
            INNER JOIN guru ON kuisioner.idguru = guru.idguru
            INNER JOIN siswabelajar ON kuisioner.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE kuisioner.idkuisioner = '".$id."'");
        $result = $command->queryAll();

        $hasil['namalengkap']                   = $result[0]['namalengkap'];
        $hasil['kelas']                         = $result[0]['kelas'];
        $hasil['namaprogram']                   = $result[0]['namaprogram'];
        $hasil['level']                         = $result[0]['level'];
        $hasil['tanggal']                       = $result[0]['tanggal'];
        $hasil['namaguru']                      = $result[0]['namaguru'];
        $hasil['penguasaanmateri']              = $result[0]['penguasaanmateri'];
        $hasil['kemampuanmengajar']             = $result[0]['kemampuanmengajar'];
        $hasil['kedisiplinan']                  = $result[0]['kedisiplinan'];
        $hasil['tanggungjawabdantingkahlaku']   = $result[0]['tanggungjawabdantingkahlaku'];
        $hasil['kerjasama']                     = $result[0]['kerjasama'];

        return $hasil;
    }
}