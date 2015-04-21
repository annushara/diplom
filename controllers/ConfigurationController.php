<?php

namespace app\controllers;


use app\models\Department;
use app\models\Store;
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
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use app\models\ValidateForm;


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
                    'move' => ['post'],
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

    public function actionMove($id)
    {

        if ($array = Yii::$app->request->post('ValidateForm')) {
            $staff = Staff::find()->where(['id_configuration' => $id])->one();//ищем владельца текущей конфигурации с которой работаем
            $conf = Configuration::findOne($id);//ищем конфигурацию с которой работаем
            $conf->old_staff = $staff['id_staff'];//записываем в эту конфигурацию id текущего владельца
            $staff->id_configuration = ''; //Обнуляем у текущего владельца конфигурацию
            $staff->save();
            $staff = Staff::findOne($array['staff']);//ищем нового владельца конфигурацией
            $staff->id_configuration = $id;//и присваеваем ему новую конфигурацию
            $conf->save();
            $staff->save();
            return $this->redirect(['configuration/view', 'id' => $id]);


        }

        $model = new ValidateForm();
        $staff = Staff::find()->all();

        $listData = ArrayHelper::map($staff, 'id_staff', 'fio');// выбирает из масиива ключ-значение

        return $this->render('move', [
            'listData' => $listData,
            'model' => $model,
            'id' => $id,
        ]);

    }

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

        return $this->redirect(['index']);
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


    public function actionAssign($id)
    {
        $id_conf = [];
        $id_staff = [];
        $staff = Staff::find()->asArray()->all();// найдем всех сотрудников

        foreach ($staff as $key) {
            $id_staff[$key['id_configuration']] = '';//перебираем массив сотрудников и складываем
            //в отдельный массив используемые конфигурации
        }
        $conf = Configuration::find()->asArray()->all();//найдем все конфигурации
        foreach ($conf as $key) {
            $id_conf[$key['id_configuration']] = '';
        }
        $result = array_diff_assoc($id_conf, $id_staff);
        return $this->render('assign');

    }



    /******************** END *******************/

    /******** Метод отображения краткой информации о сотруднике ***********/
    /*  $id   принимает из GET запроса */
    public function actionView_short_configuration($id)
    {
        /*
         * Функция принимает id сотрудника
         */

        $staff = Staff::findOne($id);

        return $this->render('view-short', [
            'staff' => $staff,
        ]);
    }

    /******************** END *******************/


    /*
     * методы для ajax форм модальных окон
     */
    public function actionWhereMove($id){

        $model = new UploadForm();
        $staff = Staff::find()->all();

        $listData = ArrayHelper::map($staff, 'id_staff', 'fio');// выбирает из масиива ключ-значение

        return $this->renderPartial('move', [
            'listData' => $listData,
            'model' => $model,
            'id'=>$id,
        ]);
    }

    public function actionSendStore(){

        $store = new Store();
        $st = new Staff();
        $staff = Staff::findOne(Yii::$app->request->post('id')); // ищем в базе сотрудников сотрудника по id конфигурации которого перемещаем на склад
        $store->id_monitor = $staff['id_monitor'];
        $store->id_configuration =$staff['id_configuration'];
        $store->id_printer =$staff['id_printer'];
/*
 * в поле old_staff в виде массива хранятся сотрудники у которых раньше была конфигурация
 * поэтому сначала проверяем существуют ли у конфигурации бывшие сотрудники
 * если нет то создаем массив и ложим в него сотрудника
 * если да то в конец массива добавляем нового сотрудника
 */
    //   $ds = Staff::findOne(Yii::$app->request->post('id'))->getIdConfiguration()->all();


//        if()
//       array_push($store->old_staff, $staff['fio']);
echo'<pre>';
        print_r(Staff::setOldStaffConfiguration(Yii::$app->request->post('id')));
        echo'/<pre>';
       //$store->save();
        return json_encode(true);
    }
    /******************** END *******************/


}


