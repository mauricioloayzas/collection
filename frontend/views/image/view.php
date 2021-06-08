<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Images */

$this->title = $model->image_unsplash_id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index', 'collection_id' => $collection_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col-12">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->image_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->image_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <img class="rounded" src="<?= $model->image_url; ?>" alt="<?= $model->image_unsplash_id; ?>">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 images-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'image_id',
                'image_unsplash_id',
                'image_status:boolean',
                [
                    'attribute'=>'text',
                    'label'=>'URL',
                    'format'=>'raw',
                    'value'=>Html::a('Access to the image', $model->image_url),
                ],
                'image_order',
            ],
        ]) ?>
    </div>
</div>
