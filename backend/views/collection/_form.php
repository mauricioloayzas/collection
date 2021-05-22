<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\User;
use common\models\UserSearch;

/* @var $this yii\web\View */
/* @var $model common\models\Collections */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="collections-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'collection_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'collection_status')->checkbox() ?>

    <?php
        $var = \yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'username');
    ?>
    <?= $form->field($model, 'user_id')->dropDownList($var, ['prompt' => 'Select an user']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
