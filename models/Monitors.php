<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monitors".
 *
 * @property integer $id
 * @property integer $id_staff
 * @property integer $id_name_monitor
 * @property string $date
 * @property string $invent_num
 * @property integer $status
 *
 * @property Staff $idStaff
 * @property NameMonitors $nameMonitor
 */
class Monitors extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const GET_HISTORY = 3;


    public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monitors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['id_staff', 'id_name_monitor','status'], 'integer'],
            [['date', 'invent_num'], 'string', 'max' => 255],
            [['id_name_monitor','name'],'valEmpty', 'skipOnEmpty' => false, 'on'=>'addMonitor'],
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
            'date' => 'Дата поступления',
            'invent_num' => 'Инвентарный №',
            'name'=>'Модель'
        ];
    }
    public function valEmpty(){

        if(empty($this->name) && empty($this->id_name_monitor)) {
            $msg = 'Выберите монитор из списка или заполните поле!';
            $this->addError('name', $msg);
            $this->addError('id_name_monitor', $msg);
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
    public function getNameMonitor()
    {
        return $this->hasOne(NameMonitors::className(), ['id' => 'id_name_monitor']);
    }

    // метод возвращает объект класса NameMonitors
    public function getObjectMonitorsName(){
        return new NameMonitors();
    }

    public function getObjectStaff(){
        return new Staff();
    }

    public function getHistoryDiscarded(){
        return $this->hasOne(HistoryMonitors::className(), ['id_configuration' => 'id']);
    }


}
