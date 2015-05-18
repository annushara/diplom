<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $comment
 * @property string $date
 * @property integer $status
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['comment'], 'required', 'message'=>'Вы не заполнили поле!'],
            [['date'], 'required', 'message'=>'Вы не указали дату!'],
            [['status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Задача',
            'date' => 'Дата выполения',
            'status' => 'Status',
        ];
    }
}
