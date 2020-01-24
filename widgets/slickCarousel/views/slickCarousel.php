<div class="slick slider flex <?= 'outer-' . trim($wrapClass) ?>">
    <?php foreach($items as $key => $item) : ?>
    <div class="item text-center">
        <?php if (key_exists('img', $item)) : ?>
            <img src="<?= $item['img'] ?>" alt="<?= key_exists('alt', $item) ? $item['alt'] : '' ?>" style="display: inline;" />
        <?php endif; ?>
        <?php if (key_exists('caption', $item)) : ?>
            <p><?= $item['caption'] ?></p>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>