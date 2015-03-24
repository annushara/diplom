<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monitors".
 *
 * @property integer $id_monitor
 * @property string $invent_num_monitor_1
 * @property string $invent_num_monitor_2
 * @property string $monitor_1
 * @property string $monitor_2
 * @property string $date_1
 * @property string $date_2
 * @property string $old_staff_1
 * @property string $old_staff_2
 *
 * @property string $staff
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
            [['invent_num_monitor_1', 'invent_num_monitor_2', 'monitor_1', 'monitor_2', 'date_1', 'date_2', 'old_staff_1', 'old_staff_2','staff'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_monitor' => 'Id Monitor',
            'invent_num_monitor_1' => 'Инв № монитора - 1',
            'invent_num_monitor_2' => 'Инв № монитора - 2',
            'monitor_1' => 'Модель монитора - 1 ',
            'monitor_2' => 'Модель монитора - 2 ',
            'date_1' => 'Дата поступления монитора - 1',
            'date_2' => 'Дата поступления монитора - 2',
            'old_staff_1' => 'Old Staff 1',
            'old_staff_2' => 'Old Staff 2',
            'staff'=>'Выберите сотрудника',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id_monitor' => 'id_monitor']);

    }
}
