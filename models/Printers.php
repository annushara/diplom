<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printers".
 *
 * @property integer $id_printer
 * @property string $invent_num_printer_1
 * @property string $invent_num_printer_2
 * @property string $invent_num_printer_3
 * @property string $invent_num_printer_4
 * @property string $invent_num_printer_5
 * @property string $print_1
 * @property string $print_2
 * @property string $print_3
 * @property string $print_4
 * @property string $print_5
 * @property string $date_1
 * @property string $date_2
 * @property string $date_3
 * @property string $date_4
 * @property string $date_5
 * @property string $old_staff_1
 * @property string $old_staff_2
 * @property string $old_staff_3
 * @property string $old_staff_4
 * @property string $old_staff_5
 */
class Printers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'printers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invent_num_printer_1', 'invent_num_printer_2', 'invent_num_printer_3', 'invent_num_printer_4', 'invent_num_printer_5', 'print_1', 'print_2', 'print_3', 'print_4', 'print_5', 'date_1', 'date_2', 'date_3', 'date_4', 'date_5', 'old_staff_1', 'old_staff_2', 'old_staff_3', 'old_staff_4', 'old_staff_5'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_printer' => 'Id Printer',
            'invent_num_printer_1' => 'Инвент № 1',
            'invent_num_printer_2' => 'Инвент № 2',
            'invent_num_printer_3' => 'Инвент № 3',
            'invent_num_printer_4' => 'Инвент № 4',
            'invent_num_printer_5' => 'Инвент № 5',
            'print_1' => 'Принтер 1',
            'print_2' => 'Принтер 2',
            'print_3' => 'Принтер 3',
            'print_4' => 'Принтер 4',
            'print_5' => 'Принтер 5',
            'date_1' => 'Дата поступления 1',
            'date_2' => 'Дата поступления 2',
            'date_3' => 'Дата поступления 3',
            'date_4' => 'Дата поступления 4',
            'date_5' => 'Дата поступления 5',
            'old_staff_1' => 'Old Staff 1',
            'old_staff_2' => 'Old Staff 2',
            'old_staff_3' => 'Old Staff 3',
            'old_staff_4' => 'Old Staff 4',
            'old_staff_5' => 'Old Staff 5',
        ];
    }
}
