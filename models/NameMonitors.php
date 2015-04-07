<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "name_monitors".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Monitors[] $monitors
 */
class NameMonitors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'name_monitors';
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
            'name' => 'Модель монитора',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitors::className(), ['name_monitor' => 'id']);
    }

    /*
     * фунция getKey() сначала проверяет есть ли такие же записи, если есть то возвращает их id
     * если нет то сохраняет название монитора и возвращает id сохраненной записи
     */
    public function getKey(){
        if($name = NameMonitors::find()->where(['name'=>$this->name])->one()) {
           return $name['id'];
        } else{
           $this->save();
            return $this->getPrimaryKey();
        }

    }
}
