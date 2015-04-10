<?php
namespace app\controllers;

use app\models\AddDepartment;
use app\models\AddStaff;
use app\models\Department;
use app\models\Monitors;
use app\models\NameMonitors;
use app\models\NamePrinters;
use app\models\NameSystemUnit;
use app\models\Printers;
use app\models\Staff;
use app\models\SystemUnit;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AddController extends Controller
{

    public function actionDepartment()
    {
        $model = new Department();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        }

        return $this->render('add-department', [
            'model' => $model,
        ]);

    }

    public function actionStaff()
    {
        $model = new Staff();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        }

        $deport = Department::find()->all();
        $listData = ArrayHelper::map($deport, 'id', 'department');
        return $this->render('add-staff', [
            'model' => $model,
            'listData' => $listData
        ]);
    }

    public function actionMonitor()
    {
        $model = new Monitors();
        $modelName = new NameMonitors();
        $model->scenario = "addMonitor"; // задаем сценарий валидации формы в моделе
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->id_name_monitor) { // если монитор выбран из списка, то сразу сохраняем в базу
                $model->save();
            } else {
                $modelName->name = $model->name; // иначе загружаем в модель название
                $model->id_name_monitor = $modelName->getKey();// вызываем функцию проверки записи которая возвращает $id  записи
                $model->save();
            }

        }

        return $this->render('monitor', [
            'model' => $model,
        ]);
    }


    public function actionSystemUnit()
    {
        $model = new SystemUnit();
        $modelName = new NameSystemUnit();
        $model->scenario = "addSystemUnit"; // задаем сценарий валидации формы в моделе
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->id_name_system_unit) { // если конфигурация выбрана из списка, то сразу сохраняем в базу
                $model->save();
            } else {
                $modelName->name = $model->name; // иначе загружаем в модель название
                $model->id_name_system_unit = $modelName->getKey();// вызываем функцию проверки записи которая возвращает $id  записи
                $model->save();
            }

        }

        return $this->render('system-unit', [
            'model' => $model,
        ]);
    }


    public function actionPrinter()
    {
        $model = new Printers();
        $modelName = new NamePrinters();
        $model->scenario = "addPrinter"; // задаем сценарий валидации формы в моделе
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->id_name_printer) { // если монитор выбран из списка, то сразу сохраняем в базу
                $model->save();
            } else {
                $modelName->name = $model->name; // иначе загружаем в модель название
                $model->id_name_printer = $modelName->getKey();// вызываем функцию проверки записи которая возвращает $id  записи
                $model->save();
            }

        }

        return $this->render('printer', [
            'model' => $model,
        ]);
    }

}
