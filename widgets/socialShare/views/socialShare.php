<?php
    use yii\helpers\Html;
    use app\components\Helper;
?>

<div class="social-share <?= trim($wrapClass) ?>">
    <div class="outer">
        <div class="inner">
            <div class="social-images">
                <?php foreach ($items as $item) : ?>
                    <?php if (!$item['mobile'] || Helper::mobileDevice()) : ?>
                    <?= Html::img($imagesFolder . $item['img'], ['alt' => $item['name'], 'width' => '34', 'data-url' => $this->context->shareData($item)]) ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>            
    <?= Html::img($imagesFolder . 'share.png', ['alt' => 'share', 'width' => '34', 'class' => 'social-toggle']) ?>
</div>