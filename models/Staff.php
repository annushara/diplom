<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property integer $id_staff
 * @property integer $id_department
 * @property integer $id_configuration
 * @property integer $id_monitor
 * @property integer $id_printer
 * @property string $name
 * @property string $patronymic
 * @property string $surname
 * @property string $fio
 *
 * @property Department $idDepartment
 * @property Configuration $idConfiguration
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_department', 'id_configuration','id_monitor', 'id_printer'], 'integer'],
            [['name', 'patronymic', 'surname', 'fio'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_staff' => 'Id Staff',
            'id_department' => 'Id Department',
            'id_configuration' => 'Id Configuration',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'surname' => 'Фамилия',
            'fio' => 'Fio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartment()
    {
        return $this->hasOne(Department::className(), ['id_department' => 'id_department']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConfiguration()
    {
        return $this->hasOne(Configuration::className(), ['id_configuration' => 'id_configuration']);
    }
}
