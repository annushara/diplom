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
 *
 * @property Staff $idStaff
 * @property NameSystemUnit $nameSystemUnit
 */
class SystemUnit extends \yii\db\ActiveRecord
{
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
            [['id_staff', 'id_name_system_unit'], 'integer'],
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
            'id_name_system_unit' => 'Name System Unit',
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
    public function getNameSystemUnit()
    {
        return $this->hasOne(NameSystemUnit::className(), ['id' => 'id_name_system_unit']);
    }
}
