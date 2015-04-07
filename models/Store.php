<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $id_store
 * @property integer $id_department
 * @property integer $id_configuration
 * @property integer $id_monitor
 * @property integer $id_printer
 * @property string $old_staff
 *
 * @property Department $idDepartment
 * @property Configuration $idConfiguration
 * @property Monitors $idMonitor
 * @property Printers $idPrinter
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_configuration', 'id_monitor', 'id_printer'], 'integer'],
            [['old_staff'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_store' => 'Id Store',
            'id_configuration' => 'Id Configuration',
            'id_monitor' => 'Id Monitor',
            'id_printer' => 'Id Printer',
            'old_staff' => 'Old Staff',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConfiguration()
    {
        return $this->hasOne(Configuration::className(), ['id_configuration' => 'id_configuration']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMonitor()
    {
        return $this->hasOne(Monitors::className(), ['id_monitor' => 'id_monitor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPrinter()
    {
        return $this->hasOne(Printers::className(), ['id_printer' => 'id_printer']);
    }
}
