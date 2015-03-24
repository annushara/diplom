<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Staff;
use \app\models\Department;


class GetStaff extends Widget
{
    public $message;
    public $listData;
    public $staff;
    public $department;

    public function init()
    {
        parent::init();
        $model = new Staff();
        $this->department = Department::find()->asArray()->all();
        //$listData = ArrayHelper::map($this->staff,'id_staff', 'fio' );
        foreach ($this->department as $arr) {
            $this->listData .= '<li><a href="#" style="color: #555555"><i></i>'.
                                $arr['department'] .
                                '<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">';

            $staff = Staff::find()->where(['id_department' => $arr['id_department']])->asArray()->all();
            foreach ($staff as $value) {


                    $this->listData .= '<li><a href="' . \Yii::$app->urlManager->createUrl(['configuration/view_short_configuration', 'id' => $value['id_staff']]) . '" ><i class="fa fa-caret-right"></i>' . ' ' . $value['fio'] .
                        '</a></li>';


            }
            $this->listData .= '</ul></li>';

        }



    }

    public function run()
    {

        return $this->listData;
    }
}