<?php
namespace app\controllers;

use app\models\Department;
use app\models\Monitors;
use app\models\Other;
use app\models\NameMonitors;
use app\models\NamePrinters;
use app\models\NameSystemUnit;
use app\models\Printers;
use app\models\Refill;
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
            if ($model->id_name_printer) { // если принтер выбран из списка, то сразу сохраняем в базу
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



    public function actionOther(){
        $model = new Other(['scenario'=>'addOther']);
        $staff = new Staff();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();

        }

        return $this->render('other', [
            'model' => $model,
            'staff' => $staff,
        ]);
    }






    /*Функция добавления заправки принтера*/
    public function actionAddRefill($id){
        $model = new Refill();


        if ($model->load(Yii::$app->request->post()) && $model->save()) { // если пришел запрос, сохраняем и возвращаемся на страницу конфигурации
            return $this->redirect(['/configuration/view_short_configuration', 'id' => Yii::$app->request->get('id')]);
        }


        $staff = Staff::findOne($id); // ищем сотрудника с которым работаем

        /* вызываем магический метод get который возвращает все объекты принтеров
        закрепленных за сотрудником и сразу все преобразуем в массив */
        $printers = ArrayHelper::map($staff->printers, 'id', 'id_name_printer');

        foreach($printers as $key => $value){
            $printers[$key] = NamePrinters::findOne($value)->name; //запрос к таблице возвращает название принтера, им заменяем в массиве id названия принтера
        }


        return $this->render('refill',[
            'model'=> $model,
            'listPrinters'=>$printers,
        ]);
    }

}
