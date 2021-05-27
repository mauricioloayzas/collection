<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ImageSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerCssFile(
    'https://use.fontawesome.com/releases/v5.0.13/css/all.css',
    ['depends' => [\yii\web\JqueryAsset::class]]
); ?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=  Html::a('Add Image', [
                'create',
                'collection_id' => $collection_id
            ], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="row">
            <?php foreach ($images as $key => $value): ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                   data-image="<?= $value->image_url ?>"
                   data-target="#image-gallery">
                    <img class="img-thumbnail" style="width: 50vw; height: 20vw;"
                         src="<?= $value->image_url ?>"
                         alt="<?= $value->image_unsplash_id ?>">
                </a>

                <?= Html::a('Update', [
                    'update',
                    'id'            => $value->image_id,
                    'collection_id' => $collection_id,
                ], ['class' => 'btn btn-primary']) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: transparent; border: 0px">
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
            </div>
            <div class="modal-footer d-flex justify-content-center" style="border: transparent">
                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                </button>

                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile(
    '@web/js/image-galery.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
); ?>
