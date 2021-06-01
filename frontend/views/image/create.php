<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Images */

$this->title = 'Add Images';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => [
    'index',
    'collection_id' => $collection_id,
]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 form-group">
            <label for="query">Serach Images</label>
            <input type="text" id="query" class="form-control">
            <input type="hidden" id="search-url" value="<?= url::toRoute(['image/search'], true) ?>">
        </div>
    </div>
    <div class="row" id="content-image-unsplash"></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php $this->registerJsFile(
    '@web/js/image.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
); ?>
