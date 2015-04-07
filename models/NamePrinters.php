<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "name_printers".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Printers[] $printers
 */
class NamePrinters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'name_printers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название принтера',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrinters()
    {
        return $this->hasMany(Printers::className(), ['id_name_printer' => 'id']);
    }

    /*
         * фунция getKey() сначала проверяет есть ли такие же записи, если есть то возвращает их id
         * если нет то сохраняет название принтера и возвращает id сохраненной записи
         */
    public function getKey()
    {
        if ($name = NamePrinters::find()->where(['name' => $this->name])->one()) {
            return $name['id'];
        } else {
            $this->save();
            return $this->getPrimaryKey();
        }
    }

}
