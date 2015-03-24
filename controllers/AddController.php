<?php
namespace app\controllers;

use app\models\AddDepartment;
use app\models\Department;
use app\models\Staff;
use app\models\AddStaff;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;

class AddController extends Controller
{

    public function actionDepartment()
    {
        $model = new AddDepartment();
        $saveDepartment = new Department();

        if(Yii::$app->request->post('AddDepartment')){
            $array = Yii::$app->request->post('AddDepartment');
            $saveDepartment->department= $array['department'];
            $saveDepartment->save();

        }


        return $this->render('add-department' ,[
        'model'=> $model,
        ]);

    }

    public function actionStaff()
    {
        $model = new AddStaff();
        $saveStaff = new Staff();

        if(Yii::$app->request->post('AddStaff')) {
            $array = Yii::$app->request->post('AddStaff');
            $saveStaff->id_department= $array['list'];
            $saveStaff->name = $array['name'];
            $saveStaff->surname = $array['surname'];
            $saveStaff->patronymic = $array['patronymic'];
            $saveStaff->fio = $array['surname'].' '.$array['name']. ' ' .$array['patronymic'];
            $saveStaff->save();




        }
        $deport = Department::find()->all();
        $listData = ArrayHelper::map($deport,'id_department', 'department' );
        return $this->render('add-staff' ,[
            'model'=> $model,
            'listData'=> $listData
        ]);
    }



}
