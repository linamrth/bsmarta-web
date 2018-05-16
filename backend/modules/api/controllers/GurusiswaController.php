<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Guru;
use backend\models\Guruskill;
use backend\models\Jadwalgenerate;

use backend\models\Rapotbelajar;
use backend\modules\api\models\RapotbelajarForm;
use backend\models\Siswabelajar;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Lessonplan;
use backend\models\Siswa;

/**
 * Default controller for the `api` module
 */
class GurusiswaController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        // $connection = Yii::$app->getDb();
        // $ambilid = $id;
        // $command = $connection->createCommand("
        //     SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level
        //     FROM siswabelajar
        //     RIGHT JOIN jadwal ON jadwal.idsiswabelajar = siswabelajar.idsiswabelajar
        //     LEFT JOIN programlevel ON programlevel.idprogramlevel = siswabelajar.idprogramlevel
        //     LEFT JOIN program ON program.idprogram = programlevel.idprogram
        //     LEFT JOIN siswa ON siswa.idsiswa = siswabelajar.idsiswa
        //     WHERE jadwal.idguru = '".$ambilid."'
        //     AND jadwal.statusjadwal = 'K'
        //     ORDER BY siswa.namalengkap");

        // $result = $command->queryAll();
        
        // return ['status'=>'OK', 'results'=>$result];

        $siswabelajar = Siswabelajar::find()
            ->select('siswabelajar.*, jadwal.*')
            ->rightJoin('jadwal', 'jadwal.idsiswabelajar = siswabelajar.idsiswabelajar')
            ->leftJoin('programlevel', 'programlevel.idprogramlevel = siswabelajar.idprogramlevel')
            ->leftJoin('siswa', 'siswa.idsiswa = siswabelajar.idsiswa')
            ->where([
                'siswabelajar.idcabang'=> '1',
                'jadwal.idguru'=> $id
                ])
            ->orderBy('siswa.namalengkap')
            ->asArray()
            ->all();

        return ['status'=>'OK', 'siswabelajar'=>$siswabelajar];
    }

    public function actionView($id)
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

    public function actionInputrapot($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $pecah = explode("_", $id);
        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$pecah[0]])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $nmsiswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $nmprogram = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();
        $lessonplan = Lessonplan::find()->where(['pertemuan'=>$pecah[1], 'idprogramlevel'=>$siswabelajar->idprogramlevel])->one();

        if(Yii::$app->request->post()){
            $model = Yii::$app->request->post();
            $tabel = new Rapotbelajar();
            $tabel->idguru              = $model['idguru'];
            $tabel->idgenerate          = $jadwalgenerate->idgenerate;
            $tabel->tanggal             = date('Y-m-d H:i:s');
            $tabel->materi              = $model['materi'];
            $tabel->hasil               = $model['hasil'];
            $tabel->halamanketercapaian = $model['halamanketercapaian'];
            $tabel->pertemuanke         = $lessonplan->pertemuan;
            $tabel->catatanguru         = $model['catatanguru'];
            $tabel->rewardhasil         = $model['rewardhasil'];
            $tabel->rewardsikap         = $model['rewardsikap'];

            if($tabel->save()) {
                return ['status'=>'OK'];
            }
            else{
                return ['status'=>'FAIL'];   
            }
        }
        else{
            return ['status'=>'OK', 'result'=>['materi'=>$lessonplan->materi, 'hal'=>$lessonplan->hal]];
        }
    }

    public function actionLihatrapot($id)
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

    public function actionAllsiswa($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $connection = Yii::$app->getDb();
        $ambilid = $id;
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level
            FROM siswabelajar
            RIGHT JOIN jadwal ON jadwal.idsiswabelajar = siswabelajar.idsiswabelajar
            LEFT JOIN programlevel ON programlevel.idprogramlevel = siswabelajar.idprogramlevel
            LEFT JOIN program ON program.idprogram = programlevel.idprogram
            LEFT JOIN siswa ON siswa.idsiswa = siswabelajar.idsiswa
            WHERE jadwal.statusjadwal = 'K'
            ORDER BY siswa.namalengkap");

        $result = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionAllsiswaview($id)
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

    public function actionAllsiswainputrapot($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $pecah = explode("_", $id);
        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$pecah[0]])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $nmsiswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $nmprogram = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();
        $lessonplan = Lessonplan::find()->where(['pertemuan'=>$pecah[1], 'idprogramlevel'=>$siswabelajar->idprogramlevel])->one();

        if(Yii::$app->request->post()){
            $model = Yii::$app->request->post();
            $tabel = new Rapotbelajar();
            $tabel->idguru              = $model['idguru'];
            $tabel->idgenerate          = $jadwalgenerate->idgenerate;
            $tabel->tanggal             = date('Y-m-d H:i:s');
            $tabel->materi              = $model['materi'];
            $tabel->hasil               = $model['hasil'];
            $tabel->halamanketercapaian = $model['halamanketercapaian'];
            $tabel->pertemuanke         = $lessonplan->pertemuan;
            $tabel->catatanguru         = $model['catatanguru'];
            $tabel->rewardhasil         = $model['rewardhasil'];
            $tabel->rewardsikap         = $model['rewardsikap'];

            if($tabel->save()) {
                return ['status'=>'OK'];
            }
            else{
                return ['status'=>'FAIL'];   
            }
        }
        else{
            return ['status'=>'OK', 'result'=>['materi'=>$lessonplan->materi, 'hal'=>$lessonplan->hal]];
        }
    }

    public function actionAllsiswalihatrapot($id)
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

    public function actionAllsiswagrafikperkembangan($id)
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