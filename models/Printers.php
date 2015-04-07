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
 *
 * @property Staff $idStaff
 * @property NamePrinters $idNamePrinter
 */

class Printers extends \yii\db\ActiveRecord
{

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
            [['id_staff', 'id_name_printer'], 'integer'],
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
            'id_name_printer' => 'Id Name Printer',
            'date' => 'Дата',
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
    public function getIdNamePrinter()
    {
        return $this->hasOne(NamePrinters::className(), ['id' => 'id_name_printer']);
    }
}
