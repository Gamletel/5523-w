<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$slides = get_field('slides');
?>
<div id="mainbanner-block" class="<?= $classes; ?> <?= $align; ?> block__padding">
    <?php if ($block_bg) { ?>
        <img src="<?= $block_bg; ?>" alt="" class="block-bg">
    <?php } ?>

    <?php if ($slides) { ?>
        <div class="swiper mainbanner-slider">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide) {
                    $title = $slide['title'];
                    $subtitle = $slide['subtitle'];
                    $bg = wp_get_attachment_image_url($slide['bg'], 'full');
                    $btn_text = $slide['btn_text'];
                    $btn_link = $slide['btn_link'];
                    ?>
                    <div class="swiper-slide">
                        <?php if ($bg) { ?>
                            <img src="<?= $bg; ?>" alt="" class="slide__bg">
                        <?php } ?>

                        <div class="slide__content">
                            <?php if ($title) { ?>
                                <h2>
                                    <?= $title; ?>
                                </h2>
                            <?php } ?>

                            <?php if ($subtitle) { ?>
                                <h5 class="gray">
                                    <?= $subtitle; ?>
                                </h5>
                            <?php } ?>

                            <?php if ($btn_link && $btn_text) { ?>
                                <a href="<?= $btn_link; ?>" class="btn">
                                    <?= $btn_text; ?>

                                    <?= inline('assets/images/arrow.svg'); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    <?php } ?>
</div>