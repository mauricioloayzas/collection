<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Collections */

$this->title = 'Update Collections: ' . $model->collection_description;
$this->params['breadcrumbs'][] = ['label' => 'Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->collection_description, 'url' => ['view', 'id' => $model->collection_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="collections-update">

    <h1><?= Html::encode($model->collection_description) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
