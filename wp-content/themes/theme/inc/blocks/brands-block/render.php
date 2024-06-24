<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = get_field('block_title');
$brands = get_field('brands');
?>
<div id="brands-block" class="<?=$classes;?> <?=$align;?> block__margin">

    <?php if ($block_title) { ?>
        <div class="block-title-wrapper">
            <h2 class="title">
                <?= $block_title; ?>
            </h2>

            <div class="swiper-btns">
                <div class="swiper-btn-prev">
                    <?= inline('assets/images/swiper-btn.svg'); ?>
                </div>

                <div class="swiper-btn-next">
                    <?= inline('assets/images/swiper-btn.svg'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    
    <?php if ($brands) {?>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($brands as $brand) { ?>
                    <div class="swiper-slide">
                        <img src="<?= wp_get_attachment_image_url($brand, 'full'); ?>" alt="">
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    
</div>