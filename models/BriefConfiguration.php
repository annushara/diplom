<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brief_configuration".
 *
 * @property integer $id_conf
 * @property integer $id_configuration
 * @property string $title
 *
 * @property Configuration $idConfiguration
 */
class BriefConfiguration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brief_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_configuration'], 'integer'],
            [['title'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_conf' => 'Id Conf',
            'id_configuration' => 'Id Configuration',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConfiguration()
    {
        return $this->hasOne(Configuration::className(), ['id_configuration' => 'id_configuration']);
    }
}
