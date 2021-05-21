<?php
namespace api\controllers;

use yii\rest\ActiveController;

use common\models\Collections;
use common\models\CollectionsQuery;

class CollectionController extends DefaultController
{
    public $modelClass = 'common\models\Collections';


    public function actionByuser($userID)
    {
        $model = new CollectionsQuery(new Collections());
        return $model->byUser($userID);
    }
}