<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelFile common\models\UploadFile */

$this->title = 'Create Images';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index', 'collection_id' => $collection_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelFile' => $modelFile,
    ]) ?>

</div>
