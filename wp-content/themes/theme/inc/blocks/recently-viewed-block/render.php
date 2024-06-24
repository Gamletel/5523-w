<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = isset($args['block_title']) ? $args['block_title'] : get_field('block_title');

$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed_2'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed_2'] ) : array();
$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
$query_args = array(
    'posts_per_page' => 8,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'post_type'      => 'product',
    'post__in'       => $viewed_products,
    'orderby'        => 'rand'
);
// Add meta_query to query args
$query_args['meta_query'] = array();
$products = get_posts($query_args);
?>
<div id="recently-viewed-block" class="<?= $classes; ?> <?= $align; ?> block__padding">
            <div class="block-title-wrapper">
                <h2 class="title">
                    Вы смотрели
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
</div>