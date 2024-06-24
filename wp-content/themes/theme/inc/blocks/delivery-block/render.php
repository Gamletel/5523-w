<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$pay_text = get_field('pay_text');
$pay_methods = get_field('pay_methods');
$delivery_text = get_field('delivery_text');
$delivery_methods = get_field('delivery_methods');
?>
<div id="delivery-block" class="<?= $classes; ?> <?= $align; ?>">

    <?php if ($block_title) { ?>
        <h2 class="title">
            <?= $block_title; ?>
        </h2>
    <?php } ?>

    <?php if ($pay_text && $pay_methods) { ?>
        <div class="pay">
            <h2>
                Оплата товара
            </h2>

            <?php if ($pay_text) { ?>
                <div class="delivery-block__text">
                    <?= $pay_text; ?>
                </div>
            <?php } ?>

            <?php if ($pay_methods) { ?>
                <div class="methods">
                    <div class="delivery-block__title">Способы оплаты</div>

                    <div class="methods__icons">
                        <?php foreach ($pay_methods as $method) { ?>
                            <img src="<?= wp_get_attachment_image_url($method, 'full'); ?>" alt="">
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ($delivery_text && $delivery_methods) { ?>
        <div class="delivery">
            <h2>
                Доставка товара
            </h2>

            <?php if ($delivery_text) { ?>
                <div class="delivery-block__text">
                    <?= $delivery_text; ?>
                </div>
            <?php } ?>

            <?php if ($delivery_methods) { ?>
                <div class="methods">
                    <div class="delivery-block__title">Способы доставки</div>

                    <div class="methods__icons">
                        <?php foreach ($delivery_methods as $method) { ?>
                            <img src="<?= wp_get_attachment_image_url($method, 'full'); ?>" alt="">
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

</div>