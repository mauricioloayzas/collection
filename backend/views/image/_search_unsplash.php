<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $imagesUnsplashes  */
?>

<?php foreach($imagesUnsplashes as $key => $value): ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-4 mb-lg-0 mt-2 thumb">
        <a href="javascript:void(0)" class="image-found" id="image-unsplash-<?= $value['id'] ?>">
            <img id="image-<?= $value['id'] ?>" class="w-100 h-100 shadow-1-strong rounded mb-4" src="<?= $value['urls']['small'] ?>" alt="<?= $value['alt_description'] ?>" />
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
