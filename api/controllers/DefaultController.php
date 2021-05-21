<?php
namespace api\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use Yii;

use common\models\User;
use common\models\UserQuery;

class DefaultController extends ActiveController
{
    public $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
}