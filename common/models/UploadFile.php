<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($user, $collection)
    {
        $folder = "images/".$user."/".$collection."/";
        if ($this->validate()) {
            $this->imageFile->saveAs($folder . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return [
                'msg'       => "File uploaded",
                'success'   => TRUE,
            ];
        } else {
            return [
                'msg'       => $this->getErrors(),
                'success'   => FALSE,
            ];
        }
    }
}