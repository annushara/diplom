<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "name_system_unit".
 *
 * @property integer $id
 * @property string $name
 *
 * @property SystemUnit[] $systemUnits
 */
class NameSystemUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'name_system_unit';
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
            'name' => 'Конфигурация',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemUnits()
    {
        return $this->hasMany(SystemUnit::className(), ['name_system_unit' => 'id']);
    }


    /*
     * фунция getKey() сначала проверяет есть ли такие же записи, если есть то возвращает их id
     * если нет то сохраняет название конфигурации и возвращает id сохраненной записи
     */
    public function getKey()
    {
        if ($name = NameSystemUnit::find()->where(['name' => $this->name])->one()) {
            return $name['id'];
        } else {
            $this->save();
            return $this->getPrimaryKey();
        }
    }
}
