<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $imagesUnsplashes  */
?>
<style>
    @media only screen and (max-width: 412px) {
        .img-thumbnail {
            width: 50vw;
            height: 30vw;
        }
    }

    @media only screen and (min-width: 413px) {
        .img-thumbnail {
            width: 50vw;
            height: 20vw !important;
        }
    }
</style>
<?php foreach($imagesUnsplashes as $key => $value): ?>
    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
        <a href="javascript:void(0)" class="thumbnail image-found" id="image-unsplash-<?= $value['id'] ?>">
            <img id="image-<?= $value['id'] ?>" class="img-thumbnail" style="width: 50vw; height: 20vw;"
                 src="<?= $value['urls']['small'] ?>" alt="<?= $value['alt_description'] ?>" />
        </a>
    </div>
<?php endforeach; ?>
<script>
    $('.image-found').click(function (){
        let arrayID = $(this).attr('id').split('-');
        let url = $('#image-'+arrayID[2]).attr('src');

        $('#images-image_unsplash_id').val(arrayID[2]);
        $('#images-image_url').val(url);

        location.href = '#submit-area'
    });
</script>
