<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property integer $id
 * @property integer $id_department
 * @property integer $id_configuration
 * @property string $fio
 * @property integer $status
 *
 * @property Department $idDepartment
 * @property Configuration $idConfiguration
 * @property Monitors $monitors
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;


    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_department','status'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            ['id_department', 'required', 'message' => 'Вы не выбрали подразделение'],
            ['fio', 'required', 'message' => 'Введите ФИО сотрудника'],
            ['fio' , 'recordExist']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Staff',
            'id_department' => 'Id Department',
            'fio' => 'ФИО сотрудника',
            'status'=>'status',
        ];
    }
    /* функция для правил (rules) проверяет существует ли  в таблице подразделений отправленная из
       формы добавления подразделения запись, если да, то возвращается ошибка с сообщением*/
    public function recordExist()
    {
        if (Staff::find()->where(['fio' => $this->fio])->one() && $this->isNewRecord) {
            $this->addError('fio', 'Сотрудник уже существует!');
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitors::className(), ['id_staff' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrinters()
    {
        return $this->hasMany(Printers::className(), ['id_staff' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'id_department']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemUnits()
    {
        return $this->hasMany(SystemUnit::className(), ['id_staff' => 'id']);
    }

    public function getOthers()
    {
        return $this->hasMany(Other::className(), ['id_staff' => 'id']);
    }



}
