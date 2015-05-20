<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

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
    public $comment;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['staff'], 'integer' ],
            [['staff'], 'required', 'message'=>'Вы не выбрали сотрудника!' ],
            [['file'], 'required', 'message'=>'Вы не выбрали файл!' ],
            [['file'], 'file',],
        ];
    }
     function getStaffList(){
        $staff = Staff::find()->where(['status'=>Staff::STATUS_ACTIVE])->all();
        $listData = ArrayHelper::map($staff, 'id', 'fio');// выбирает из масиива ключ-значение
        return $listData;
    }
}


