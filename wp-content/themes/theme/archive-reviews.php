<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

get_header();
?>

    <main id="primary" class="archive archive-reviews">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <div class="page-title-wrapper">
                <h1 class="page-title">
                    Отзывы
                </h1>

                <button class="btn" data-modal="review">Оставить отзыв</button>
            </div>


            <?php if (have_posts()) { ?>

                <div class="archive__holder">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                        $icon = get_the_post_thumbnail_url($post, 'full');
                        $name = get_the_title();
                        $date = get_field('date');
                        $text = get_the_content();
                        $images = get_post_field('images');
                        ?>

                        <div class="archive__item">

                            <div class="review__user">
                                <?php if ($icon) { ?>
                                    <img src="<?= $icon; ?>" alt="" class="review__logo">
                                <?php } ?>

                                <div class="review__user-info">
                                    <?php if ($name) { ?>
                                        <h2><?= $name; ?></h2>
                                    <?php } ?>

                                    <?php if ($date) { ?>
                                        <div class="review__date"><?= $date; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if ($text) { ?>
                                <div class="review__text">
                                    <?= $text; ?>
                                </div>

                                <div class="readmore">
                                    Читать полностью
                                </div>
                            <?php } ?>

                            <?php if ($images) { ?>
                                <div class="review__images">
                                    <?php foreach ($images as $image) { ?>
                                        <img data-fancybox='gallery' data-src='<?= wp_get_attachment_image_url($image, 'full'); ?>' src="<?= wp_get_attachment_image_url($image, 'full'); ?>" alt="">
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>

                    <?php endwhile; ?>
                </div>

                <?php

                get_template_part('inc/parts/pagination');

            } else {

                get_template_part('template-parts/content', 'none');

            }
            ?>
        </div>

    </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
