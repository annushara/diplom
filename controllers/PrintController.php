<?php
namespace app\controllers;


use Yii;
use app\models\Staff;
use app\models\BriefConfiguration;
use app\models\Department;
use app\models\Monitors;
use app\models\SearchMonitors;
use app\models\Configuration;
use app\models\ConfigurationSearch;
use app\models\Printers;
use kartik\mpdf\Pdf;
use yii\base\Controller;


class PrintController extends Controller
{
    public function actionCard(){
        $id = Yii::$app->request->get('id');
        $id_staff = Staff::findOne($id);  // ищем сотрудника по id
        $id_mon = Monitors::findOne($id_staff['id_monitor']); //ищем его конфигурацию мониторов
        $id_brief = BriefConfiguration::find()->where(['id_configuration'=>$id_staff['id_configuration']])->one(); // ищем его краткую конфигурацию системного блока
        $id_print = Printers::findOne($id_staff['id_printer']); // ищем его принтеры
        $id_deport = Department::findOne($id_staff['id_department']); //отделение
        $id_conf = Configuration::findOne($id_staff['id_configuration']);// полная конфигурация
/*
 *  если был запрос на печать карточки сотрудника, то еще одним параметром type передается  тип card
 * проверяем есть этот параметр в Get запросе, если есть указываем вид print-card как шаблон иначе вид print-qrcode
 */
        if (Yii::$app->request->get('type') == 'card') {
            $print = 'print-card';
        }else{

           $print= 'print-qrcode';
        }

            $qrcode = $id_staff->fio . ' ' . $id_mon->monitor_1 . ' ' . $id_brief->title;
            $content = $this->renderPartial($print, [
                'staff' => $id_staff,
                'brief_conf' => $id_brief,
                'monitors' => $id_mon,
                'printers' => $id_print,
                'department' => $id_deport,
                'configuration' => $id_conf,
                'qrcode' => $qrcode,
            ]);

        $this->Pdf($content);

    }



    public function Pdf($content){


        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'content' => $content,
            'options' => [
                'title' => 'Карточка сотрудника',
                'subject' => ''
            ],

        ]);
        return $pdf->render();
    }
}