<?php

namespace app\controllers;


use app\models\Department;
use app\models\HistoryMonitors;
use app\models\HistoryPrinters;
use app\models\HistorySystemUnit;
use app\models\SystemUnit;
use app\models\UploadForm;
use Yii;
use app\models\Monitors;
use app\models\SearchMonitors;
use app\models\Configuration;
use app\models\ConfigurationSearch;
use app\models\Printers;
use app\models\SearchPrinters;
use app\models\Staff;
use app\models\Refill;
use app\models\SearchRefill;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;



/**
 * ConfigurationController implements the CRUD actions for Configuration model.
 *
 */
/*@var $id ид сотрудника */
class ConfigurationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'move-monitor'=>['post'],

                ],
            ],
        ];
    }

    /**
     * Lists all Configuration models.
     * @return mixed
     */

    /************** Методы CRUD для работы с конфигурацией*****************/

    /***********Показывает все содержимое базы конфигурации позволяя редактировать*******/
    public function actionIndex_configuration()
    {
        $searchModel = new ConfigurationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Configuration model.
     * @param integer $id
     * @return mixed
     */

    /************Показывает выбранную конфигурацию***********/
    public function actionView_configuration($id)
    {
        if ($id == 0) { //если ноль значит у сотрудника нет конфигурации
            $fio = Staff::find()->where(['id_staff' => $staff])->asArray()->one();
            return $this->render('not_configuration', [ //реднерим вид и предлагаем назначить конфигурацию
                'staff' => $staff,
                'fio' => $fio['fio'],
            ]);
        } else {
            $staff = Staff::find()->where(['id_configuration' => $id])->asArray()->one();
            return $this->render('view', [
                'model' => $this->findModel_configuration($id),
                'staff' => $staff['fio'],
            ]);
        }
    }


    /**
     * Creates a new Configuration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**************Метод добавления новой конфигурации*****************/
    public function actionCreate_configuration()
    {
        $model = new Configuration();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_configuration]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Configuration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */


    /****************  Метод для обновления конфигурации  ***********/
    public function actionUpdate_configuration($id)
    {

        $model = $this->findModel_configuration($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_configuration]);
        } else {
            $brief = BriefConfiguration::find()->where(['id_configuration' => $id])->one();
            $model->attributes = [
                'title' => $brief['title'],
            ];
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Configuration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    /**********  Метод удаляющий конфигурацию ****************/
    public function actionDelete_configuration($id)
    {

        $staff = Staff::find()->where(['id_configuration' => $id])->one();//сначала ищем в таблице сотрудников
        $staff->id_configuration = '';//id конфигурации и удаляем, если этого не сделать, вылазит ошибка из за связи
        $staff->update();//о внешнем ключе который зависим от конфигурации и удаления не будет

        $this->findModel_configuration($id)->delete();

        return $this->redirect(['index']);
    }


    /************* Ищет модель конфигурации по id ************/
    protected function findModel_configuration($id)
    {
        if (($model = Configuration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /******************* END CRUD Configuration ********************/


    /***************  Методы для работы с CRUD мониторов********************/
    public function actionIndex_monitors()
    {
        $searchModel = new SearchMonitors();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/monitors/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Monitors model.
     * @param integer $id
     * @return mixed
     */
    public function actionView_monitors($id)
    {
        return $this->render('/monitors/view', [
            'model' => $this->findModel_monitors($id),
        ]);
    }

    /**
     * Creates a new Monitors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_monitors()
    {
        $model = new Monitors();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/view/monitors', 'id' => $model->id_monitor]);
        } else {
            return $this->render('/monitors/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Monitors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate_monitors($id)
    {

        $model = $this->findModel_monitors($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/monitors/view', 'id' => $model->id_monitor]);
        } else {
            return $this->render('/monitors/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Monitors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete_monitors($id)
    {
        $this->findModel_monitors($id)->delete();

        return $this->redirect(['/monitors/index']);
    }

    /**
     * Finds the Monitors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Monitors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel_monitors($id)
    {
        if (($model = Monitors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /******************* END CRUD Monitors ********************/

    /***************** Методы для CRUD принтеров ******************/

    public function actionIndex_printers()
    {
        $searchModel = new SearchPrinters();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/printers/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Printers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView_printers($id)
    {
        return $this->render('/printers/view', [
            'model' => $this->findModel_printers($id),
        ]);
    }

    /**
     * Creates a new Printers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_printers()
    {
        $model = new Printers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/printers/view', 'id' => $model->id_printer]);
        } else {
            return $this->render('/printers/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Printers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate_printers($id)
    {
        $model = $this->findModel_printers($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/printers/view', 'id' => $model->id_printer]);
        } else {
            return $this->render('/printers/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Printers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete_printers($id)
    {
        $this->findModel_printers($id)->delete();

        return $this->redirect(['/printers/index']);
    }

    /**
     * Finds the Printers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Printers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel_printers($id)
    {
        if (($model = Printers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /******************* END CRUD Printers ********************/



    public function actionIndex_refill()
    {
        $searchModel = new SearchRefill();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/refill/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Refill model.
     * @param integer $id
     * @return mixed
     */
    public function actionView_refill($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Refill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_refill()
    {
        $model = new Refill();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Refill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate_refill($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Refill model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete_refill($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/site/index']);
    }

    /**
     * Finds the Refill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Refill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Refill::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }






    /******************** END *******************/

    /******** Метод отображения краткой информации о сотруднике ***********/
    /*  $id   принимает из GET запроса */
    public function actionView_short_configuration($id)
    {
        /*
         * Функция принимает id сотрудника
         */
        /* @var $staff Staff */


        $staff = Staff::findOne($id);
        if(!$staff) {                                                    // если сотрудник с таким id не найден, то генерируем исключение 404
            throw new HttpException(404, 'Такого сотрудника не существует!');
        }else if($staff->status == 0){
            throw new HttpException(404, 'Выбранный сотрудник находится в списке уволенных!');
        }else {

            return $this->render('view-short', [
                'staff' => $staff,
            ]);
        }
    }

    /******************** END *******************/


    /*
     * методы для ajax форм модальных окон
     */
    public function actionGetFormMove($id , $one = ''){

        $model = new UploadForm();
        $staff = Staff::find()->all();
        $listData = ArrayHelper::map($staff, 'id', 'fio');// выбирает из масиива ключ-значение

        if($one){
            return $this->renderPartial('move-one', [
                'listData' => $listData,
                'model' => $model,
                'id' => $id,
            ]);
        }else {
            return $this->renderPartial('move-all', [
                'listData' => $listData,
                'model' => $model,
                'id' => $id,
            ]);
        }
    }




    /******************** END *******************/


    /*метод переносящий все конфигурации закрепленные за сотрудником на склад*/
    /*если у конфигурации отсутвует(не назначен сотрудник за которым она закреплена, считается что она находится на складе)*/

    public function actionSendToStore(){
        /* @var $staff Staff */

        $staff = Staff::findOne(Yii::$app->request->post('id'));        // ищем сотрудника по его id



        if(!$staff) {                                                    // если сотрудник с таким id не найден, то генерируем исключение 404
            throw new HttpException(404, 'Такого сотрудника не существует!');
        }else {

            $this->Move($staff->monitors, new HistoryMonitors()); //вызываем метод Move и передаем массив найденых обектов
            $this->Move($staff->systemUnits, new HistorySystemUnit()); // и объект класса History*
            $this->Move($staff->printers, new HistoryPrinters());

            if(Yii::$app->request->post('status') == '1'){
                $staff->status = '0';
                $staff->save();
                return $this->goHome();

            }


            return 'true';
        }

    }


    public function actionSendToStaff(){
        $staff = Staff::findOne(Yii::$app->request->post('oldStaff'));        // ищем сотрудника по его id
        $newStaff = Yii::$app->request->post('newStaff');

        if(!Staff::findOne($newStaff)) {                                                    // если сотрудник с таким id не найден, то генерируем исключение 404
            throw new HttpException(404, 'Такого сотрудника не существует!');
        }else {

                        //$staff->monitors магический метод который находит все закрепленые за сотрудником мониторы
            $this->Move($staff->monitors, new HistoryMonitors(), $newStaff); //вызываем метод Move и передаем массив найденых обектов
            $this->Move($staff->systemUnits, new HistorySystemUnit(), $newStaff); // и объект класса History*
            $this->Move($staff->printers, new HistoryPrinters(), $newStaff);

            return 'true';
        }
    }


    /*
     * функция принимает массив объектов
     */
    private function Move($data, $historyModel, $newStaff = '', $comment = '') {

        if (is_array($data) && !empty($data)) {                       //если массив с объектами не пустой
            foreach ($data as $key => $value) {  // то перебираем его
               $this->addHistoryMove($value,  new $historyModel(), $newStaff, $comment); // присваиваем id сотрудника, таблице history*
                $value->id_staff = $newStaff;      // присваиваем id нового сотрудника, если такого нет, то присвоится значение по умолчания ""
                $value->save();                     // сохраняем
            }
        } else if(is_object($data)){
            $this->addHistoryMove($data,  new $historyModel(), $newStaff, $comment); // присваиваем id сотрудника, таблице history*
            $data->id_staff = $newStaff;      // присваиваем id нового сотрудника, если такого нет, то присвоится значение по умолчания ""
            $data->save();                     // сохраняем
        }
    }
    /******************** END *******************/



/*
 * HistoryMove  функция  добавления истории перемещения конфигурации
 * Оборудование считается на складе если у него
 * не назначен сотрудник, а именно id_staff = NULL
 */

    private function addHistoryMove($modelMove, $modelHistory, $newStaff = '', $comment = ''){
        /*
         * @property $modelMove объект класса конфигурации (монитор, принтер и т.д ) который перемещаем
         * @property $modelHistory объект класса ActiveRecord, таблица истории конфигурации
         */
        $modelHistory->old_staff = $modelMove->id_staff;   // присваиваем таблице истории бывшему сотруднику id текущего сотрудника
        $modelHistory->new_staff = $newStaff;
        $modelHistory->id_configuration = $modelMove->id; // присваиваем таблице истории id конфигурации конфигурации
        $modelHistory->date = date("d.m.o"); // получаем текущую дату и присваиваем таблице истории соответсвующему столбцу
        $modelHistory->comment = $comment; // присваиваем комментарий
        $modelHistory->save(); // сохраняем

    }


    // методы перпемещения единичной конфигурации оборудования
    public function actionMoveMonitor(){

        $id = Yii::$app->request->post('id'); // присваиваем переменной id конфигурации которую перемещаем на склад
        $newStaff = Yii::$app->request->post('newStaff'); // получаем id нового сотрудника(если он существует)
        $comment = Yii::$app->request->post('comment'); // комментарий к перемещению
        $history = new HistoryMonitors(); // создаем и присваиваем переменной объект для работы с таблицей истории перемещений
        $monitor= Monitors::findOne($id); // ищем  конфигурацию монитора
        $id_staff=$monitor->id_staff;
        $this->Move($monitor, $history,$newStaff, $comment);

        return $this->redirect(['configuration/view_short_configuration', 'id' =>$id_staff]); // для того чтоб обновить данные в таблице заново вызываем соответсвующий метод


    }



    public function actionMoveSystemUnit(){

        $id = Yii::$app->request->post('id');// присваиваем переменной id конфигурации которую перемещаем на склад
        $newStaff = Yii::$app->request->post('newStaff');
        $comment = Yii::$app->request->post('comment'); // комментарий к перемещению
        $history = new HistorySystemUnit(); // создаем и присваиваем переменной объект для работы с таблицей истории перемещений
        $system= SystemUnit::findOne($id); //ищем конфигурацию по id
        $id_staff=$system->id_staff; // присваиваем переменной id сотрудника
        $this->Move($system, $history,$newStaff, $comment);

        return $this->redirect(['configuration/view_short_configuration', 'id' =>$id_staff]);


    }

    public function actionMovePrinter(){

        $id = Yii::$app->request->post('id');// присваиваем переменной id конфигурации которую перемещаем на склад
        $newStaff = Yii::$app->request->post('newStaff');
        $comment = Yii::$app->request->post('comment'); // комментарий к перемещению
        $history = new HistoryPrinters();
        $printer= Printers::findOne($id);
        $id_staff=$printer->id_staff; // присваиваем переменной id сотрудника
        $this->Move($printer, $history,$newStaff, $comment);

        return $this->redirect(['configuration/view_short_configuration', 'id' =>$id_staff]);

    }


}


