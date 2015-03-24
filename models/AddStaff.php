<?php
namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class AddStaff extends Model{
    public $name;
    public $surname;
    public $patronymic;
    public $list;

    public function rules(){
        return [
            ['list', 'required', 'message' => 'Выберете подразделение'],
            ['name', 'required', 'message' => 'Введите Имя сотрудника'],
            ['surname','required', 'message'=>'Введите Фамилию сотрудника'],
            ['patronymic','required', 'message'=>'Введите Отчество сотрудника'],
        ];
    }

}

