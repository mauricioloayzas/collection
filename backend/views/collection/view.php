<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;
use common\models\UserSearch;

/* @var $this yii\web\View */
/* @var $model common\models\Collections */

$this->title = $model->collection_id;
$this->params['breadcrumbs'][] = ['label' => 'Collections', 'url' => ['index', 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="collections-view">

    <h1><?= Html::encode($model->collection_description) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->collection_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->collection_id], [
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
            'collection_id',
            'collection_description',
            'collection_status:boolean',
            [
                'attribute' => 'User',
                'value' => function ($model) {
                    $user = User::findIdentity($model->user_id);
                    return $user->getUsername();
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
