<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>"
     data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <div class="swiper swiper-woocommerce-single-product">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <?php if ($post_thumbnail_id) { ?>
                    <a>
                        <img data-fancybox="<?= wp_get_attachment_image_url($post_thumbnail_id, 'full'); ?>"
                             data-src="<?= wp_get_attachment_image_url($post_thumbnail_id, 'full'); ?>"
                             src="<?= wp_get_attachment_image_url($post_thumbnail_id, 'full'); ?>" alt="">
                    </a>
                <?php } else { ?>
                    <a>
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/placeholder.png'; ?>"
                             alt="placeholder">
                    </a>
                <?php } ?>
            </div>

            <?php
            if (!empty($attachment_ids)) {
                foreach ($attachment_ids as $attachment_id) {
                    ?>
                    <div class="swiper-slide">
                        <a>
                            <img data-fancybox="<?= wp_get_attachment_image_url($attachment_id, 'full'); ?>"
                                 data-src="<?= wp_get_attachment_image_url($attachment_id, 'full'); ?>"
                                 src="<?= wp_get_attachment_image_url($attachment_id, 'full'); ?>" alt="">
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="swiper-btn-prev">
            <?= inline('assets/images/swiper-btn.svg'); ?>
        </div>
        <div class="swiper-btn-next">
            <?= inline('assets/images/swiper-btn.svg'); ?>
        </div>
    </div>

    <div class="thumbnails-wrapper">
        <div class="swiper swiper-woocommerce-single-product-thumbnails">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?php if ($post_thumbnail_id) { ?>
                        <a>
                            <?php
                            echo wp_get_attachment_image($post_thumbnail_id, 'full');
                            ?>
                        </a>
                    <?php } else { ?>
                        <a>
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/placeholder.png'; ?>"
                                 alt="placeholder">
                        </a>
                    <?php } ?>
                </div>
                <?php
                if (!empty($attachment_ids)) {
                    foreach ($attachment_ids as $attachment_id) {
                        ?>
                        <div class="swiper-slide">
                            <a>
                                <?php echo wp_get_attachment_image($attachment_id, 'full') ?>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="swiper-btn-next">
            <?= inline('assets/images/swiper-btn.svg'); ?>
        </div>
    </div>

    <?php
    do_action('woocommerce_product_thumbnails');
    ?>
</div>