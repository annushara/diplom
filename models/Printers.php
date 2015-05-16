<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printers".
 *
 * @property integer $id
 * @property integer $id_staff
 * @property integer $id_name_printer
 * @property string $date
 * @property string $invent_num
 * @property integer $status
 *
 * @property Staff $idStaff
 * @property NamePrinters $idNamePrinter
 */

class Printers extends \yii\db\ActiveRecord
{
    public $name;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const GET_HISTORY = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'printers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_staff', 'id_name_printer' , 'status'], 'integer'],
            [['date', 'invent_num'], 'string', 'max' => 255],
            [['id_name_printer','name'],'valEmpty', 'skipOnEmpty' => false, 'on'=>'addPrinter'],
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
            'id_name_printer' => 'Id Name Printer',
            'date' => 'Дата',
            'invent_num' => 'Инвентарный №',
            'name'=>'Название принтера',
        ];
    }

    public function valEmpty(){

        if(empty($this->name) && empty($this->id_name_printer)) {
            $msg = 'Выберите принтер из списка или заполните поле!';
            $this->addError('name', $msg);
            $this->addError('id_name_printer', $msg);
        }
    }

    // метод возвращает объект класса NameMonitors
    public function getObjectPrinters(){
        return new NamePrinters();
    }

    public function getObjectStaff(){
        return new Staff();
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
    public function getIdNamePrinter()
    {
        return $this->hasOne(NamePrinters::className(), ['id' => 'id_name_printer']);
    }

    public function getHistoryDiscarded(){
        return $this->hasOne(HistoryPrinters::className(), ['id_configuration' => 'id']);
    }
}
