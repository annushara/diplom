<?php

namespace app\controllers;


use app\models\Department;
use app\models\Monitors;
use app\models\Other;
use app\models\Printers;
use app\models\SearchMonitors;
use app\models\SearchOthers;
use app\models\SearchPrinters;
use app\models\SearchStaff;
use app\models\SearchSystemUnits;
use app\models\Staff;
use app\models\Configuration;
use app\models\Refill;
use app\models\SearchRefill;
use app\models\SearchStore;
use app\models\SystemUnit;

use app\models\Task;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        list($taskMissed,$taskToday,$taskWeak) = $this->getTask();


        return $this->render('index',[
            'taskToday'=> $taskToday,
            'taskWeak'=>$taskWeak,
            'taskMissed'=>$taskMissed,

        ]);


    }

    /*функция возвращает 3 параметра
     * 1 пропущенные задачи дата которых меньше сегодняшней, но статус равен 1, то есть задача не выполнена
     * 2 задачи на сегодня, все задачи дата которых совпадает с сегодняшней
     * 3 задачи на неделю, все дачаи начиная с понедельника заканчивая воскресеньем, относительно текущей недели
    */
    function getTask(){

        /*ищем все задачи на сегодня*/
        $taskToday = Task::find()
            ->where(['date'=>date("o-m-d")])
            ->andWhere(['status'=>1])
            ->all();

        /*получаем дату воскресенья текущей недели*/
        $max= date("o-m-d" ,strtotime("Sunday"));
        /*получаем дату понедельника текущей недели*/
        $min = date("o-m-d" ,strtotime("next Monday")-604800);

        /*ищем все задачи на неделю*/
        $taskWeak = Task::find()
            ->where(['>=','date',$min])
            ->andWhere(['<=','date',$max])
            ->andWhere(['status'=>1])
            ->all();

        /*ищем все пропущенные задачи*/
        $taskMissed = Task::find()
            ->where(['<','date',date("o-m-d")])
            ->andWhere(['status'=>1])
            ->all();
        return [$taskMissed,$taskToday,$taskWeak];
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /* Методы отображения списанного оборудования */
    public function actionDiscardedMonitors (){
        $searchModel = new SearchMonitors();
        $dataProvider = $searchModel->search(Monitors::STATUS_INACTIVE);
        return $this->render('discarded',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'Списанные конфигурации мониторов',
        ]);
    }

    public function actionDiscardedUnits (){
        $searchModel = new SearchSystemUnits();
        $dataProvider = $searchModel->search(SystemUnit::STATUS_INACTIVE);
        return $this->render('discarded',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'Списанные конфигурации системных блоков',
        ]);
    }

    public function actionDiscardedPrinters (){
        $searchModel = new SearchPrinters();
        $dataProvider = $searchModel->search(Printers::STATUS_INACTIVE);
        return $this->render('discarded',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'Списанные конфигурации принтеров',
        ]);
    }

    public function actionDiscardedOthers (){
        $searchModel = new SearchOthers();
        $dataProvider = $searchModel->search(Other::STATUS_INACTIVE);
        return $this->render('discarded',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'Списанные конфигурации прочего оборудования',
        ]);
    }

    /* методы отображают историю перемещений*/
    public function actionViewHistoryMoveMonitors (){
        $searchModel = new SearchMonitors();
        $dataProvider = $searchModel->search(Monitors::GET_HISTORY);
        return $this->render('history-move',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'История перемещений мониторов',
        ]);
    }

    public function actionViewHistoryMoveUnits (){
        $searchModel = new SearchSystemUnits();
        $dataProvider = $searchModel->search(SystemUnit::GET_HISTORY);
        return $this->render('history-move',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'История перемещений системных блоков',
        ]);
    }

    public function actionViewHistoryMovePrinters (){
        $searchModel = new SearchPrinters();
        $dataProvider = $searchModel->search(Printers::GET_HISTORY);
        return $this->render('history-move',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'История перемещений принтеров',
        ]);
    }

    public function actionViewHistoryMoveOthers (){
        $searchModel = new SearchOthers();
        $dataProvider = $searchModel->search(Other::GET_HISTORY);
        return $this->render('history-move',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title'=>'История перемещений прочего оборудования',
        ]);
    }


    public function actionViewStoreMonitors(){
        $searchModel = new SearchStore();
        $dataProvider = $searchModel->search('0');
        return $this->render('/monitors/index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewStoreUnits(){
        $searchModel = new SearchStore();
        $dataProvider = $searchModel->search('1');
        return $this->render('/configuration/index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewStorePrinters(){
        $searchModel = new SearchStore();
        $dataProvider = $searchModel->search('2');
        return $this->render('/printers/index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewStoreOthers(){
        $searchModel = new SearchStore();
        $dataProvider = $searchModel->search('3');
        return $this->render('/others/index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /* отображает заправленные картриджи*/
    public function actionViewRefill(){
        $searchModel = new SearchRefill();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('/refill/view-refill',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddTask(){
        $model = new Task();

        if(Yii::$app->request->post()){
            $model->comment = $_POST['comment'];
            $model->date = $_POST['date'];
            $model->save();
            return $this->goHome();

        }


        return $this->renderAjax('add-task',[
        'model'=> $model,

        ]);
    }


    /* Метод изменяет статус задачи на выполнено*/
    public function actionTaskDone($id){
        /* @var $task Task*/
        $task = Task::findOne($id);
        $task->status = 0;
        $task->save();

        list($taskMissed,$taskToday,$taskWeak) = $this->getTask();


        return $this->render('index',[

            'taskToday'=> $taskToday,
            'taskWeak'=>$taskWeak,
            'taskMissed'=>$taskMissed,

        ]);
    }

}
