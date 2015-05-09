<?php

namespace app\controllers;


use app\models\Department;
use app\models\Monitors;
use app\models\Other;
use app\models\Printers;
use app\models\SearchMonitors;
use app\models\SearchOther;
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
use Yii;
use yii\filters\AccessControl;
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
        $searchModel = new SearchRefill();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchStore = new SearchStore();
        $dataStore = $searchStore->search(Yii::$app->request->queryParams);



        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchStore' => $searchStore,
            'dataStore' => $dataStore,
        ]);


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






}
