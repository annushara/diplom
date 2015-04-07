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
 *
 * @property Staff $idStaff
 * @property NameMonitors $nameMonitor
 */
class Monitors extends \yii\db\ActiveRecord
{
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
            [['id_staff', 'id_name_monitor'], 'integer'],
            [['date', 'invent_num'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_staff' => 'Id Staff',
            'date' => 'Дата поступления',
            'invent_num' => 'Инвентарный №',
        ];
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
}
