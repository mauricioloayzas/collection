<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\li;

use common\models\User;
use common\models\UserSearch;
use frontend\services\Image;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php if (Yii::$app->user->isGuest): ?>
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
    <?php else: ?>
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">They are your active collections!</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= Html::a('Create Collection', ['site/create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'collection_id',
                            [
                                'attribute' => 'Collection Description',
                                'value' => function ($model) {
                                    $url = Url::toRoute(['site/view/'.$model['collection_id']]);
                                    return Html::a(
                                        $model['collection_description'],
                                        $url,
                                        ['title' => 'Images',]
                                    );
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'Image Quantity',
                                'class' => 'yii\grid\DataColumn',
                                'value' => function ($data) {
                                    $imageService = new Image();
                                    $images = $imageService->getListByCollections(Yii::$app->user->identity->getAuthKey(), $data['collection_id']);
                                    return count($images);
                                },
                            ],
                            [
                                'attribute' => 'See the images',
                                'value' => function ($model) {
                                    $url = '#';
                                    //$url = Url::toRoute(['collection/index',  'user_id' => $model->id], true);
                                    return Html::a(
                                        'Images',
                                        $url,
                                        ['title' => 'Images',]
                                    );
                                },
                                'format' => 'raw',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
