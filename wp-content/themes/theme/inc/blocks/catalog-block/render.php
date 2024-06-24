<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = get_field('block_title');
$btn_text = get_field('btn_text');
$btn_link = get_field('btn_link');
$categories = get_field('categories');
?>
<div id="catalog-block" class="<?=$classes;?> <?=$align;?> block__padding">

    <div class="block-title-wrapper">
        <h2 class="title">
            <?= $block_title; ?>
        </h2>

        <?php if ($btn_text || $btn_text) {?>
            <a href="<?= $btn_link; ?>" class="link">
                <?= $btn_text; ?>

                <?= inline('assets/images/arrow.svg'); ?>
            </a>
        <?php } ?>
    </div>


    <?php if ($categories) {?>
        <div class="categories">
            <?php
            wc_get_template('loop/loop-start.php');

            foreach ($categories as $term) {
                wc_get_template(
                    'content-product_cat.php',
                    array(
                        'category' => $term,
                    )
                );
            }
            ?>

            <?php
            wc_get_template('loop/loop-end.php');
            ?>
        </div>
    <?php } ?>
</div>