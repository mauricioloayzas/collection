<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php $var = [ true => 'Admin', false => 'Normal User']; ?>
    <?= $form->field($model, 'admin')->dropDownList($var, ['prompt' => 'Select an option..' ]); ?>

    <?php if(is_numeric($model->id) && $model->id > 0): ?>
    <?php $var = [ 0 => 'Deleted', 9 => 'Inactive', 10 => 'Active']; ?>
    <?= $form->field($model, 'status')->dropDownList($var, ['prompt' => 'Select an option..' ]); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
