<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuration".
 *
 * @property integer $id_configuration
 * @property string $invent_num_system
 * @property string $cpu
 * @property string $motherboard
 * @property string $graphics
 * @property string $hdd_1
 * @property string $hdd_2
 * @property string $memory_1
 * @property string $memory_2
 * @property string $memory_3
 * @property string $memory_4
 * @property string $mac
 * @property string $date
 * @property string $old_staff
 *
 * @property BriefConfiguration[] $briefConfigurations
 * @property Staff[] $staff
 */
class Configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $title;
    public static function tableName()
    {
        return 'configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invent_num_system', 'cpu', 'motherboard', 'graphics', 'hdd_1', 'hdd_2', 'memory_1', 'memory_2', 'memory_3', 'memory_4', 'mac', 'date', 'old_staff','title'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_configuration' => 'id',
            'invent_num_system' => 'Инв№ сист. блока',
            'cpu' => 'Процессор',
            'motherboard' => 'Материнская плата',
            'graphics' => 'Графический процессор',
            'hdd_1' => 'Жесткий диск - 1',
            'hdd_2' => 'Жесткий диск - 2',
            'memory_1' => 'RAM Планка 1',
            'memory_2' => 'RAM Планка 2',
            'memory_3' => 'RAM Планка 3 ',
            'memory_4' => 'RAM Планка 4',
            'mac' => 'Mac адресс',
            'date' => 'Дата поступления',
            'old_staff'=> 'Бывший сотрудник',
            'title' =>'Краткое название конфигурации',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBriefConfigurations()
    {
        return $this->hasMany(BriefConfiguration::className(), ['id_configuration' => 'id_configuration']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id_configuration' => 'id_configuration']);
    }
}
