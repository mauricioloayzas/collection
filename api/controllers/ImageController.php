<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\web\UploadedFile;
use Yii;

use common\models\Images;
use common\models\UploadFile;


class ImageController extends DefaultController
{
    public $modelClass = 'common\models\Collections';


    public function actionBycollection($collectionID)
    {
        /*$model = new ImageQuery(new Collections());
        return $model->byUser($userID);*/
    }


    public function actionUploadimage()
    {
        $model = new UploadFile();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->getBodyParams();
            if(!is_dir(Yii::$app->basePath."/web/images/".$data['user'])){
                mkdir(Yii::$app->basePath."/web/images/".$data['user'], 0777);
            }

            if(!is_dir(Yii::$app->basePath."/web/images/".$data['user']."/".$data['collection'])){
                mkdir(Yii::$app->basePath."/web/images/".$data['user']."/".$data['collection'], 0777);
            }

            $folder = Yii::$app->basePath."/web/images/".$data['user']."/".$data['collection']."/";
            $model->imageFile = UploadedFile::getInstanceByName('imageFile');
            return $model->upload($folder);
        }
    }
}