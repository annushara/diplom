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