<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\ActionColumn'],

                'username',
                'email:email',
                'admin:boolean',
                [
                    'attribute' => 'collections',
                    'value' => function ($model) {
                        $url = Url::toRoute([
                            'collection/index',
                            'user_id'   => $model->id
                        ]);
                        return Html::a(
                            'collections',
                            $url,
                            ['title' => 'collections',]
                        );
                    },
                    'format' => 'raw',
                ],
            ],
        ]); ?>
    </div>
</div>
