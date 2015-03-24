<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $staff;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['staff'], 'integer' ],
            [['staff'], 'required', 'message'=>'Вы не выбрали сотрудника!' ],
            [['file'], 'required', 'message'=>'Вы не загрузили файл!' ],
            [['file'], 'file',],
        ];
    }
}


