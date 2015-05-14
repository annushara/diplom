<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history_other".
 *
 * @property integer $id
 * @property integer $old_staff
 * @property integer $new_staff
 * @property integer $id_configuration
 * @property string $comment
 * @property string $date
 * @property integer $status
 *
 * @property Other $idConfiguration
 * @property Staff $oldStaff
 * @property Staff $newStaff
 */
class HistoryOther extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_other';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_staff', 'new_staff', 'id_configuration', 'status'], 'integer'],
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
            'id_configuration' => 'Id Configuration',
            'comment' => 'Комментарий',
            'date' => 'Дата перемещения',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConfiguration()
    {
        return $this->hasOne(Other::className(), ['id' => 'id_configuration']);
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
