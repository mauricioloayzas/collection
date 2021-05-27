<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Collections */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="collections-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'collection_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
