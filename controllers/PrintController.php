<?php
namespace app\controllers;


use app\models\HistoryMonitors;
use app\models\HistoryOther;
use app\models\HistoryPrinters;
use app\models\HistorySystemUnit;
use Yii;
use app\models\Staff;
use app\models\Department;
use app\models\Monitors;
use app\models\SearchMonitors;
use app\models\Configuration;
use app\models\ConfigurationSearch;
use app\models\Printers;
use kartik\mpdf\Pdf;
use yii\base\Controller;
use app\models\UniversalModel;
use yii\db\Connection;

class PrintController extends Controller
{
    public function actionCard(){
        $id = Yii::$app->request->get('id');
        $staff = Staff::findOne($id);  // ищем сотрудника по id
/*
 *  если был запрос на печать карточки сотрудника, то еще одним параметром type передается  тип card
 * проверяем есть этот параметр в Get запросе, если есть указываем вид print-card как шаблон иначе вид print-qrcode
 */
        if (Yii::$app->request->get('type') == 'card') {
            $print = 'print-card';
        }else{

           $print= 'print-qrcode';
        }


            $content = $this->renderPartial($print, [
                'staff' => $staff,
            ]);

        $this->Pdf($content,'Карточка сотрудника');

    }

    public function actionPrintAct(){
      //  $mount = ['1'=>['0'=>'2015-05-12','1'=>'2015-06-12']];
        $model = new UniversalModel(['scenario'=>'mount']);

       if(Yii::$app->request->post()){

           // получаем порядковый номер месяца выбранного пользователем
           $mount = $_POST['UniversalModel']['mount'];

           //формируем дату начала месяца
           // и приводим к виду год-порядковый номер месяца-число пример('2015-06-12')
           $min = date('o'). '-'.$mount . '-' . 1;

           //формируем дату конца конца периода создания отчета,
           // концом периода считается 1 число слудющего за выбранным месяца
           $max = date('o'). '-'.++$mount . '-' . 1;

           //формируем запросы поочередно к каждой таблице с историей,
           // которые ищут в таблицах все записи в указанный перидот
           $monitors = $this->findDestroy(new HistoryMonitors(), $min,$max);
           $units = $this->findDestroy(new HistorySystemUnit(), $min,$max);
           $printers = $this->findDestroy(new HistoryPrinters(), $min,$max);
           $others = $this->findDestroy(new HistoryOther(), $min,$max);

               echo '<br><br><br><br>';
               echo '<pre>';
               print_r($printers);
               echo '</pre>';
           $content =  $this->renderPartial('print-act',[
               'monitors'=>$monitors,
               'units'=>$units,
               'printers'=>$printers,
               'others'=>$others,


           ]);
           $this->Pdf($content,'Акт на списание');
           }
        return $this->render('/site/select-mount',[
            'model'=>$model
        ]);
    }

    /* делает запрос к базе данных
    * $object объект для работы с таблицей
     * $min, $max период времени в днях
    */
    function findDestroy($object,$min,$max){
        $query = $object::find()
            ->where(['>=','date',$min])
            ->andWhere(['<=','date',$max])
            ->andWhere(['status'=>0])
            ->all();
        return $query;
    }


    /* функция формирует pdf документ из данных которые были переданы*/
    public function Pdf($content, $title){


        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'content' => $content,
            'options' => [
                'title' => $title,
                'subject' => ''
            ],

        ]);
        return $pdf->render();
    }
}