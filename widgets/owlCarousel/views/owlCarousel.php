<div class="owl-carousel owl-theme <?= 'outer-' . trim($wrapClass) ?>">
    <?php foreach($items as $key => $item) : ?>
    <div class="item">
        <?php if (key_exists('img', $item)) : ?>
            <img src="<?= $item['img'] ?>" alt="<?= key_exists('alt', $item) ? $item['alt'] : '' ?>" />
        <?php endif; ?>
        <?php if (key_exists('caption', $item)) : ?>
            <p><?= $item['caption'] ?></p>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>