<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "refill".
 * Модель таблицы заправок
 * @property integer $id
 * @property integer $id_printer
 * @property string $comment
 * @property string $date
 *
 * @property Printers $idPrinter
 */
class Refill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_printer'], 'integer'],
            ['id_printer', 'required', 'message' => 'Вы не выбрали принтер'],
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
            'id_printer' => 'Список принтеров',
            'comment' => 'Комментарий',
            'date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPrinter()
    {
        return $this->hasOne(Printers::className(), ['id' => 'id_printer']);
    }
}
