<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_unit".
 *
 * @property integer $id
 * @property integer $id_staff
 * @property integer $id_name_system_unit
 * @property string $date
 * @property string $invent_num
 * @property integer $status
 *
 * @property Staff $idStaff
 * @property NameSystemUnit $nameSystemUnit
 */
class SystemUnit extends \yii\db\ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_staff', 'id_name_system_unit', 'status'], 'integer'],
            [['date', 'invent_num'], 'string', 'max' => 255],
            [['id_name_system_unit','name'],'valEmpty', 'skipOnEmpty' => false, 'on'=>'addSystemUnit'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_staff' => 'Сотрудники',
            'id_name_system_unit' => 'Name System Unit',
            'date' => 'Дата поступления',
            'invent_num' => 'Инвентарный №',
            'name'=>'Конфигурация'
        ];
    }

    public function valEmpty(){

        if(empty($this->name) && empty($this->id_name_system_unit)) {
            $msg = 'Выберите конфигурацию из списка или заполните поле!';
            $this->addError('name', $msg);
            $this->addError('id_name_system_unit', $msg);
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'id_staff']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNameSystemUnit()
    {
        return $this->hasOne(NameSystemUnit::className(), ['id' => 'id_name_system_unit']);
    }

    // метод возвращает объект класса NameMonitors
    public function getObjectSystemName(){
        return new NameSystemUnit();
    }

    public function getObjectStaff(){
        return new Staff();
    }
}
