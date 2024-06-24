<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$args = array(
    'post_type' => 'product',
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 8,
);
$products = get_posts($args);
?>
<div id="popular-block" class="<?= $classes; ?> <?= $align; ?> block__padding">
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

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($products as $item) { ?>
                <div class="swiper-slide">

                    <?php

                    $product = wc_get_product($item);

                    $post_object = get_post($product->get_id());

                    setup_postdata($GLOBALS['post'] =& $post_object);

                    wc_get_template_part('content', 'product');
                    ?>

                </div>
            <?php } ?>
        </div>
    </div>

    <?php /* echo do_shortcode('[products limit="4" columns="4" orderby="popularity" class="quick-sale" on_sale="true" ]') */ ?>
</div>