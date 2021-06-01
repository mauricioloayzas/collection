<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Images */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image_unsplash_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'image_url')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?php if($model->image_id > 0): ?>
    <?= $form->field($model, 'image_order')->textInput(['maxlength' => true])->label("order") ?>
    <?php endif; ?>

    <div class="form-group" id="submit-area">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
