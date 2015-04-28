<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history_system_unit".
 *
 * @property integer $id
 * @property integer $old_staff
 * @property integer $new_staff
 * @property integer $id_configuration
 * @property string $comment
 * @property string $date
 *
 * @property SystemUnit $idSystemUnit
 * @property Staff $oldStaff
 * @property Staff $newStaff
 */
class HistorySystemUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_system_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_staff', 'new_staff', 'id_configuration'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_staff' => 'Old Staff',
            'new_staff' => 'New Staff',
            'id_configuration' => 'Id System Unit',
            'comment' => 'Comment',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSystemUnit()
    {
        return $this->hasOne(SystemUnit::className(), ['id' => 'id_configuration']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOldStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'old_staff']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'new_staff']);
    }
}
