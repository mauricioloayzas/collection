<?php

namespace api\controllers;

use yii\rest\ActiveController;

/**
 * UserController implements the CRUD REST for Users model.
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
}
