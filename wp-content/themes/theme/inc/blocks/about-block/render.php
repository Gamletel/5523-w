<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$image = wp_get_attachment_image_url(get_field('image'), 'full');
$text = get_field('text');
$advantages = get_field('advantages');
?>
<div id="about-block" class="<?= $classes; ?> <?= $align; ?>">
    <div class="container">
        <div class="about__content">
            <?php if ($image) { ?>
                <img src="<?= $image; ?>" alt="">
            <?php } ?>

            <div class="about__info">
                <?php if ($text) { ?>
                    <div class="about__text">
                        <?= $text; ?>
                    </div>
                <?php } ?>

                <?php if ($advantages) { ?>
                    <div class="advantages">
                        <?php foreach ($advantages as $advantage) {
                            $title = $advantage['title'];
                            $subtitle = $advantage['subtitle'];
                            ?>
                            <div class="advantage">
                                <?php if ($title) { ?>
                                    <div class="advantage__title">
                                        <?= $title; ?>
                                    </div>
                                <?php } ?>

                                <?php if ($subtitle) { ?>
                                    <div class="advantage__subtitle">
                                        <?= $subtitle; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>