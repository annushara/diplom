<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $id
 * @property string $department
 *
 * @property Staff[] $staff
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department'], 'string', 'max' => 255],
            ['department', 'required' , 'message'=>'Введите название подразделения!'],
            ['department' , 'recordExist']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => 'Department',
        ];
    }

    /* функция для правил (rules) проверяет существует ли  в таблице подразделений отправленная из
    формы добавления подразделения запись, если да, то возвращается ошибка с сообщением*/
    public function recordExist(){
        if(Department::find()->where(['department'=>$this->department])->one()) {
            $this->addError('department', 'Подразделение уже существует!');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id_department' => 'id']);
    }
}
