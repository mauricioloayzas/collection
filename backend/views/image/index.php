<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Collections;
use common\models\CollectionsQuery;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ImageSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if((int)$collection_id > 0): ?>
        <p>
            <?= Html::a('Create Images', ['create',  'collection_id' => $collection_id], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

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

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    <?php else: ?>
    <p>Collection has not been chosen</p>
    <?php endif; ?>
</div>