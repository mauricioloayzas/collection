<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Collections;
use common\models\CollectionsQuery;

/* @var $this yii\web\View */
/* @var $model common\models\Images */

$this->title = $model->image_id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index', 'collection_id' => $collection_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="images-view">

    <h1><?= Html::encode($model->image_description) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'image_id',
            'image_description',
            'image_status:boolean',
            [
                'attribute' => 'Collection',
                'value' => function ($model) {
                    $collectionQuery = new CollectionsQuery(new Collections());
                    $collection = $collectionQuery->byID($model->collection_id)->toArray();
                    return $collection['collection_description'];
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
