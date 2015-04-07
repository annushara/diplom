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

    public function actionDepartment(){
        $model = new Department();
        if ($model->load(Yii::$app->request->post()) && $model->save()){

        }

        return $this->render('add-department' ,[
        'model'=> $model,
        ]);

    }

    public function actionStaff()
    {
        $model = new Staff();

        if ($model->load(Yii::$app->request->post()) && $model->save()){

        }

        $deport = Department::find()->all();
        $listData = ArrayHelper::map($deport,'id', 'department' );
        return $this->render('add-staff' ,[
            'model'=> $model,
            'listData'=> $listData
        ]);
    }



}
