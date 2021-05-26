<?php
namespace api\controllers;

use yii\rest\ActiveController;

use common\models\Collections;
use common\models\CollectionsQuery;

class CollectionController extends DefaultController
{
    public $modelClass = 'common\models\Collections';


    public function actionFindbyid($collectionID)
    {
        $model = new CollectionsQuery(new Collections());
        return $model->byID($collectionID);
    }


    public function actionByuser($userID)
    {
        $model = new CollectionsQuery(new Collections());
        return $model->byUser($userID);
    }


    public function actionUpdatedata($collectionID)
    {
        $data =[
            'Collections'   => \Yii::$app->request->post(),
        ];
        $model = new CollectionsQuery(new Collections());
        $collection = $model->byID($collectionID);
        $collection->load($data);
        if($collection->save()){
            $response = $collection->toArray();
        }else{
            $response = [
                'msg'   => 'error to save the data',
                'success' => FALSE,
            ];
        }

        return $response;
    }
}