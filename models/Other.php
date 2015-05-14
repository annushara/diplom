<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "other".
 *
 * @property integer $id
 * @property integer $id_staff
 * @property string $category
 * @property string $name
 * @property string $date
 * @property string $invent_num
 * @property integer $status
 *
 * @property Staff $idStaff
 */
class Other extends \yii\db\ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const GET_HISTORY = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_staff', 'status'], 'integer'],
            [['id_staff', 'category', 'name'], 'required' , 'message' => 'Поле обязательное для заполения','on'=>'addOther'],
            [['category', 'name', 'date', 'invent_num'], 'string', 'max' => 255]
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
            'category' => 'Тип устройства',
            'name' => 'Название',
            'date' => 'Дата',
            'invent_num' => 'Инвентарный №',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'id_staff']);
    }

    public function getHistoryDiscarded(){
        return $this->hasOne(HistoryOther::className(), ['id_configuration' => 'id']);
    }
}
