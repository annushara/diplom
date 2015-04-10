<?php
namespace app\controllers;


use app\models\NameMonitors;
use app\models\NamePrinters;
use app\models\NameSystemUnit;
use app\models\SearchMonitors;
use app\models\SystemUnit;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\UploadForm;
use app\models\Configuration;
use app\models\Staff;
use app\models\Monitors;
use app\models\Printers;
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
        $listData = ArrayHelper::map($staff, 'id', 'fio');// выбирает из масиива ключ-значение

        return $this->render('upload', [
            'model' => $model,
        ]);

    }

    public function actionMonitors($id)
    {
        $model = new Monitors();
        $modelName = new NameMonitors();
        $session = new Session();


        if ($modelName->load(Yii::$app->request->post())){ // загружаем в модель NameMonitors название монитора
            $model->load(Yii::$app->request->post());   // загружаем в модель Monitors инвентарный № и дату поступления
            $model->id_staff = $id; // устанавливаем id сотрудника к оторому относится монитор
            /*
             * устанавливаем id названия монитора, вызвав функцию getKey() которая возвращает id последней
             * сохраненой записи названия монитора, но если запись повторяется то id существующей записи
             */
            $model->id_name_monitor = $modelName->getKey(); // получаем id и присваиваем
            $model->save();




            return $this->redirect(['upload/configuration', 'id' => Yii::$app->request->get('id')]);
        }



        $modelName->attributes = [      //заполняем атрибуты модели данными из массива
            'name' => $session['config']['монитор1'],
            ];

        return $this->render('/monitors/create', [
            'model' => $model,
            'modelName'=>$modelName,

        ]);

    }


    public function actionConfiguration($id)
    {
        $model = new SystemUnit();
        $modelName =new NameSystemUnit();
        $session = new Session();

        if ($modelName->load(Yii::$app->request->post())){ // загружаем в модель NameSystemUnit() название монитора
            $model->load(Yii::$app->request->post());   // загружаем в модель SystemUnit() инвентарный № и дату поступления
            $model->id_staff = $id; // устанавливаем id сотрудника к оторому относится монитор
            /*
             * устанавливаем id названия конфигурации, вызвав функцию getKey() которая возвращает id последней
             * сохраненой записи названия конфигурации, но если запись повторяется то id существующей записи
             */
            $model->id_name_system_unit = $modelName->getKey(); // получаем id и присваиваем
            $model->save();

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

        $modelName->attributes = [                  //заполняем модель данными
            'name'=>   'CPU -'.
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
            'modelName'=> $modelName,
        ]);
    }


    public function actionPrinters($id)
    {
        $model = new Printers();
        $modelName = new NamePrinters();
        $session = new Session();


        if (Yii::$app->request->post()) {

            for($i = 0; $i <= 2; $i++){

            if(!empty($_POST['NamePrinters']['name'][$i])) {
                /*
                 * создаем новые экземпляры классов, иначе если не создать, вместо сохранения на каждой
                 * последующей итерации данные обновляются
                 */
                $model = new Printers();
                $modelName = new NamePrinters();

                //загружаем в можель название принтера
                $modelName->name = $_POST['NamePrinters']['name'][$i];

                $model->id_staff = $id;// id сотрудника
                $model->invent_num = $_POST['Printers']['invent_num'][$i]; //инвентарный номер
                $model->date = $_POST['Printers']['date'][$i]; // дату
                $model->id_name_printer = $modelName->getKey(); // получаем id названия(внешний ключ)

                $model->save();

                }

            }
            // редирект на главную страницу приложения
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
            'modelName'=> $modelName,
            'listData' => $listData,
        ]);
    }



}