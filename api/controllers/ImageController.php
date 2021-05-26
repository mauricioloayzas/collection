<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\web\UploadedFile;
use Yii;

use common\models\Images;
use common\models\ImagesQuery;
use common\models\UploadFile;


class ImageController extends DefaultController
{
    public $modelClass = 'common\models\Images';


    public function actionBycollection($collectionID)
    {
        $model = new ImagesQuery(new Images());
        return $model->byCollections($collectionID);
    }


    public function actionFindbyid($imageID)
    {
        $model = new ImagesQuery(new Images());
        return $model->byID($imageID);
    }


    public function actionUpdatedata($imageID)
    {
        $data =[
            'Images'   => \Yii::$app->request->post(),
        ];
        $model = new ImagesQuery(new Images());
        $image = $model->byID($imageID);
        $image->load($data);
        if($image->save()){
            $response = $image->toArray();
        }else{
            $response = [
                'msg'   => 'error to save the data',
                'success' => FALSE,
            ];
        }

        return $response;
    }
}