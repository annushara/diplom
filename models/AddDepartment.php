<?php
namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class AddDepartment extends Model{
    public $department;


    public function rules(){
        return [
            ['department', 'required' , 'message'=>'Введите название подразделения!']
        ];
    }

}
