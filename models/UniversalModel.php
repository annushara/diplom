<?php
    namespace app\models;

    use yii\base\Model;

    class UniversalModel extends Model
    {
     /*
      * Универсальный класс для форм
      *
      */

        public $mount;

        public function rules()
        {
            return [

                [['mount'],'required',  'on'=>'mount','message'=>'Вы не выбрали месяц!'],
            ];
        }


    }


