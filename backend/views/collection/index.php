<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use common\models\User;
use common\models\UserSearch;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CollectionSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Collections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collections-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Collections', [
            'create',
            'user_id'   => $user_id,
        ], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\ActionColumn'],

                'collection_description',
                'collection_status:boolean',
                'user.email:email',
                [
                    'attribute' => 'Images',
                    'value' => function ($model) {
                        $url = Url::toRoute(['image/index', 'collection_id' => $model->collection_id]);
                        return Html::a(
                            'images',
                            $url,
                            ['title' => 'images',]
                        );
                    },
                    'format' => 'raw',
                ],
            ],
        ]); ?>
    </div>
</div>
