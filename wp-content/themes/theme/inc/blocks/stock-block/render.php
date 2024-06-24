<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$image = wp_get_attachment_image_url(get_field('image'), 'full');
$block_title = get_field('block_title');
$additional_text = get_field('additional_text');
$btn_text = get_field('btn_text');
$btn_link = get_field('btn_link');
?>
<div id="stock-block" class="<?= $classes; ?> <?= $align; ?> block__margin">
    <?php if ($image) { ?>
        <img src="<?= $image; ?>" alt="" class="block__bg">
    <?php } ?>

    <div class="block__content">
        <?php if ($block_title) { ?>
            <h2 class="title">
                <?= $block_title; ?>
            </h2>
        <?php } ?>

        <div class="block__content-bottom">
            <?php if ($btn_text || $btn_link) { ?>
                <a href="<?= $btn_link; ?>" class="btn btn-arrow white">
                    <?= $btn_text; ?>

                    <?= inline('assets/images/arrow-right.svg'); ?>
                </a>
            <?php } ?>

            <?php if ($additional_text) { ?>
                <h4>
                    <?= $additional_text; ?>
                </h4>
            <?php } ?>
        </div>
    </div>
</div>