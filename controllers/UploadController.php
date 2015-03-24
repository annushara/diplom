<?php
namespace app\controllers;


use app\models\SearchMonitors;
use app\models\ValidateForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\UploadForm;
use app\models\Configuration;
use app\models\Staff;
use app\models\Monitors;
use app\models\Printers;
use app\models\BriefConfiguration;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\web\Response;
use yii\helpers\ArrayHelper;


class UploadController extends Controller
{
    public $data;


    public function actionUpload()
    {
        $array = array(
            'тип цп' => '',
            'системная плата' => '',
            'видеоадаптер1' => '',
            'монитор1' => '',
            'монитор2' => '',
            'дисковый накопитель1' => '',
            'дисковый накопитель2' => '',
            'дисковый накопитель3' => '',
            'дисковый накопитель4' => '',
            'дисковый накопитель5' => '',
            'первичный адрес mac' => '',
            'принтер1' => '',
            'принтер2' => '',
            'принтер3' => '',
            'принтер4' => '',
            'принтер5' => '',
            'принтер6' => '',
            'принтер7' => '',
            'принтер8' => '',
            'принтер9' => '',
            'принтер10' => '',
        );
        $mem = array(
            'имя модуля' => array(
                'модуль1' => '',
                'модуль2' => '',
                'модуль3' => '',
                'модуль4' => ''),
            'размер модуля' => array(
                'модуль1' => '',
                'модуль2' => '',
                'модуль3' => '',
                'модуль4' => ''),
            'скорость памяти' => array(
                'модуль1' => '',
                'модуль2' => '',
                'модуль3' => '',
                'модуль4' => ''),
        );
        $model = new UploadForm();
        $session = new Session();

        if (Yii::$app->request->isPost) { //если пришел post запрос, заполняем модель
            $model->file = UploadedFile::getInstance($model, 'file'); //добовляем файл в модель
           $model->staff = $_POST['UploadForm']['staff']; // добовляем сотрудника в модель



            if ($model->file && $model->validate()) {

                $file = fopen($model->file->tempName, 'r');
                $count = 0;
                while ($count++ < 900) {
                    $data = fgets($file, 1024); // считываем построчно весь файл

                    /* так как файлы с конфигурацией в кодировке windows-1251, то */
                    $data = iconv('windows-1251', 'UTF-8', $data); //меняем  кодировку на utf8

                    @list($names, $inf, $info) = explode("|", $data);// знак @ предотвращяет ошибку
                    @list($type, $equipment) = explode("=", $inf);  //а она вылазит когда функция explode возращает строку
                    @list($name, $types) = explode("=", $info); //в который нет трех слов, результат list() выбрасывает ошибку

                    foreach ($array as $key => $value) {
                        if (mb_strtolower($type, 'UTF-8') == $key) {
                            $array[$key] = $equipment;
                        }
                        if ((mb_strtolower(substr($names, 0, 3), 'UTF-8') == 'spd')) {
                            foreach ($mem as $keys => $values) {
                                if (mb_strtolower($name, 'UTF-8') == $keys) {
                                    switch (substr($names, -1)) {
                                        case '1':
                                            $mem[$keys]['модуль1'] = $types;
                                            break;

                                        case '2':
                                            $mem[$keys]['модуль2'] = $types;
                                            break;

                                        case '3':
                                            $mem[$keys]['модуль3'] = $types;
                                            break;

                                        case '4':
                                            $mem[$keys]['модуль4'] = $types;
                                            break;

                                    }
                                }

                            }
                        }

                    }


                }

                $session->open();
                $session['config'] = $array;
                $session['memory'] = $mem;

                return $this->redirect(['upload/monitors', 'id'=>$_POST['UploadForm']['staff']]);

            }
        }

        $staff = Staff::find()->all();
        $listData = ArrayHelper::map($staff, 'id_staff', 'fio');// выбирает из масиива ключ-значение

        return $this->render('upload', [
            'model' => $model,
            'listData' => $listData,
        ]);

    }

    public function actionMonitors()
    {
        $model = new Monitors();
        $session = new Session();


        if ($array = Yii::$app->request->post()) {

           // $id_staff = ArrayHelper::remove($array['Monitors'], 'staff');
            $model->load($array);
            $model->save();
            $key = $model->getPrimaryKey(); //получаем последний id конфигурации
            $updateStaff = Staff::findOne(Yii::$app->request->get('id')); // делаем запрос к таблице сотрудники, с id выбранным в форме
            $updateStaff->id_monitor = $key;// добавляем id конфигурации к выбранному сотруднику
            $updateStaff->save(); // и обновляем запись в базе данных
            return $this->redirect(['upload/configuration', 'id' => Yii::$app->request->get('id')]);
        }



        $model->attributes = [      //заполняем атрибуты модели данными из массива
            'monitor_1' => $session['config']['монитор1'],
            'monitor_2' => $session['config']['монитор2'],
            'old_staff_1' => '{0}',
            'old_staff_2' => '{0}',];

        return $this->render('/monitors/create', [
            'model' => $model,

        ]);

    }


    public function actionConfiguration()
    {
        $model = new Configuration();
        $session = new Session();
        $briefModel = new BriefConfiguration();

        if ($model->load($array = Yii::$app->request->post()) && $model->save()) {
            $key = $model->getPrimaryKey(); //получаем последний id конфигурации
            $briefModel->id_configuration = $key; //пишем в таблицу с кратким названием конфигурации id  конфигурации
            $briefModel->title = $array['Configuration']['title']; // записываем краткое название
            $updateStaff = Staff::findOne(Yii::$app->request->get('id')); // делаем запрос к таблице сотрудники, с id выбранным в форме
            $updateStaff->id_configuration = $key;// добавляем id конфигурации к выбранному сотруднику
            $updateStaff->save(); // и обновляем запись в базе данных
            $briefModel->save(); // сохраняем
            return $this->redirect(['upload/printers', 'id' => Yii::$app->request->get('id')]);
        }

        /* переберем массив с RAM чтоб задать полям значения по дефолту если планка отсутсвует */
        $ram = [1 => '', 2 => '', 3 => '', 4 => '']; // массив для хранения

        foreach ($session['memory'] as $key => $value) { //перебираем основной массив $key = 'имя модуля' $value = [модуль1],[модуль2]...
            $count = 0;                                 //счетчик
            foreach ($value as $key2 => $value2) {  // перебираем значения
                $count++;
                if ($value2 !== '') {   // если мадуль1, модуль2 не пустой, присваеваем значение. И так в цикле получаем
                    $ram[$count] .= '(' . $value2 . ')' . ' '; // строку вида (Kingston 99U5474-013.A00LF) (2 Гб (1 rank, 8 banks)) (DDR3-1333 (667 МГц))
                }
            }
        }

        $model->attributes = [                  //заполняем модель данными
            'cpu' => $session['config']['тип цп'],
            'motherboard' => $session['config']['системная плата'],
            'graphics' => $session['config']['видеоадаптер1'],
            'hdd_1' => $session['config']['дисковый накопитель1'],
            'hdd_2' => $session['config']['дисковый накопитель2'],
            'memory_1' => $ram[1],
            'memory_2' => $ram[2],
            'memory_3' => $ram[3],
            'memory_4' => $ram[4],
            'mac' => $session['config']['первичный адрес mac'],
            'date' => '',
            'title'=>   'CPU -'.
                $session['config']['тип цп']. ' , '.
                    'RAM -'.
                $session['memory']['размер модуля']['модуль1'].' , '.
                $session['memory']['размер модуля']['модуль2'].'  '.
                $session['memory']['размер модуля']['модуль3'].'  '.
                $session['memory']['размер модуля']['модуль4'].'  '.
                    'HDD -'.
                $session['config']['дисковый накопитель1'],
        ];

        return $this->render('/configuration/create', [
            'model' => $model,
        ]);
    }


    public function actionPrinters()
    {
        $model = new Printers();
        $session = new Session();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $key = $model->getPrimaryKey(); //получаем последний id конфигурации
            $updateStaff = Staff::findOne(Yii::$app->request->get('id')); // делаем запрос к таблице сотрудники, с id выбранным в форме
            $updateStaff->id_printer = $key;// добавляем id конфигурации к выбранному сотруднику
            $updateStaff->save(); // и обновляем запись в базе данных
            $session->destroy(); // уничтожаем сессию
            return $this->redirect(Yii::$app->homeUrl, 302);
        }

        /*
         * для того чтоб создать список из принтеров напишем цикл перебора массива в другой массив
         */

        foreach ($session['config'] as $key=>$value) {

            if (preg_match("/принтер[0-9]/",$key)){ //если удовлетворяет регулярному выражению 'принтер-любое число'
                $listData[$value]=$value; //ложим в массив значение получается $listData['название принтера']=название принтера
            }
            }

        return $this->render('/printers/create', [
            'model' => $model,
            'listData' => $listData,
        ]);
    }



}