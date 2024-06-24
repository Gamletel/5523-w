<?php

class WooThemeFunctions
{
    /*
     * WC GLOBAL
     */

    public function truemisha_recently_viewed_product_cookie()
    {

        // если находимся не на странице товара, ничего не делаем
        if (!is_product()) {
            return;
        }


        if (empty($_COOKIE['woocommerce_recently_viewed_2'])) {
            $viewed_products = array();
        } else {
            $viewed_products = (array)explode('|', $_COOKIE['woocommerce_recently_viewed_2']);
        }

        // добавляем в массив текущий товар
        if (!in_array(get_the_ID(), $viewed_products)) {
            $viewed_products[] = get_the_ID();
        }

        // нет смысла хранить там бесконечное количество товаров
        if (sizeof($viewed_products) > 15) {
            array_shift($viewed_products); // выкидываем первый элемент
        }

        // устанавливаем в куки
        wc_setcookie('woocommerce_recently_viewed_2', join('|', $viewed_products));

    }

    public function wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        ?>
        <div id="cart-count" class="icon__count">
            <?php
            if (WC()->cart->get_cart_contents_count() > 99) {
                echo '99+';
            } else {
                echo WC()->cart->get_cart_contents_count();
            }
            ?>
        </div>
        <?php
        $fragments['#cart-count'] = ob_get_clean();
        return $fragments;
    }

    public function register_my_widgets()
    {
        register_sidebar(
            array(
                'name' => 'Фильтр товаров',
                'id' => "sidebar-shop",
                'description' => '',
                'class' => '',
                'before_sidebar' => '',
                'after_sidebar' => '',
            )
        );
    }

    /*
     * CATEGORY-CARD
     */

    public function remove_count()
    {
        $html = '';
        return $html;
    }

    public function category_image_wrapper($category)
    {
        ?>
        <div class="image-wrapper">
            <?php woocommerce_subcategory_thumbnail($category); ?>
        </div>
        <?php
    }

    public function theme_catalog_size($size)
    {
        return 'full';
    }

    public function custom_category_top_part($category)
    {
        $shortDescription = get_field('s-description', $category);
        ?>
        <div class="category-top">
            <h4 class="woocommerce-loop-category__title">
                <?php
                echo esc_html($category->name);
                if ($category->count > 0) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category);
                }
                ?>
            </h4>

            <div class="btn-main disabled-color">
                Подробнее
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <?php
            if ($shortDescription) { ?>
                <div class="short-descr">
                    <?php echo $shortDescription; ?>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }

    public function custom_category_see_more_btn()
    {
        echo '';
    }

    /*
     * PRODUCT-CARD
     */
    function tb_woo_custom_cart_button_text()
    {
        return __('Добавить', 'woocommerce');
    }

    public function custom_template_loop_product_thumbnail()
    {
        global $product;

        ?>
        <div class="image-wrapper">
            <?php woocommerce_template_loop_product_thumbnail();
            ?>
        </div>
        <?php
    }

    public function wp_kama_woocommerce_loop_add_to_cart_args_filter($array, $product)
    {
        $arrayResult = $array;
        $arrayResult['class'] = $arrayResult['class'] . ' btn-main';

        return $arrayResult;
    }

    public function custom_content_after_archive_products()
    {
        show_post('shop');
    }

    public function wp_kama_woocommerce_get_price_html_filter($price, $that)
    {
        global $product;

        $sale_p = $product->get_sale_price();
        $reg_p = $product->get_regular_price();
        $result = 100 - (($sale_p / $reg_p) * 100);

        if ('' === $product->get_price()) {
            $price = apply_filters('woocommerce_empty_price_html', '', $this);
        } else {
            if ($product->is_on_sale()) {
                $price = "
    <div class='price__regular-wrapper'>
        <span class='price__regular-crossed'>" . wc_price($reg_p) . "</span>
        
        <span class='sale-percent'>" . round($result) . "%" . "</span>
    </div>
    
    <span class='price__sale'>" . wc_price($sale_p) . "</span>";
            } else {
                $price = "
<span class='price__regular'>" . wc_price($reg_p) . "</span>";
            }
        }

        return $price;
    }

    public function custom_link()
    {
        global $product;
        ?>
        <div class="product-bottom">
            <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
                <span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span>
            <?php endif; ?>

            <?php echo '<div class="bodym ' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            <div class="price-wrapper">
                <?php
                if ($product->get_price()) { ?>
                    <?php woocommerce_template_loop_price(); ?>
                <?php } else {
                    echo '<span class="price">Цена <br> по запросу</span>';
                }
                ?>

                <?php
                global $product;

                echo apply_filters(
                    'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
                    sprintf(
                        '<a href="%s" data-quantity="%s" class="%s btn add-to-cart-btn" %s>%s</a>',
                        esc_url($product->add_to_cart_url()),
                        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
                        esc_attr(isset($args['class']) ? $args['class'] : 'button'),
                        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
                        esc_html($product->add_to_cart_text())
                    ),
                    $product,
                    $args
                );

                ?>
            </div>
        </div>
        <?php
    }

    /*
     * PAGE-FAVORITES
     */

//    public function updateFavorites()
//    {
//        if (WCFAVORITES()->count_items() > 99) {
//            echo '99+';
//        } else {
//            echo WCFAVORITES()->count_items();
//        }
//        wp_die();
//    }
//
//    public function wc_clear_favorite_url()
//    {
//        if (isset($_REQUEST['clear-fav'])) {
//            unset($_COOKIE['WC_FAVORITES']);
//        }
//    }

    /*
     * PRODUCT-PAGE
     */

    public function custom_single_product_top_summary()
    {
        global $product;

        $attributes = $product->get_attributes();

        if (!empty($attributes)) { ?>
            <div class="summary-right-attrs right-item">
                <h2 class="title">Характеристики</h2>

                <table class="woocommerce-product-attributes shop_attributes">
                    <tbody>
                    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_dev">
                        <th class="woocommerce-product-attributes-item__label">
                            Артикул
                        </th>

                        <td class="woocommerce-product-attributes-item__value">
                            <p><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></p>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <?php echo wc_display_product_attributes($product); ?>

                <div id="show-all-vars-btn" class="link">
                    Все характеристики
                </div>
            </div>
            <?php
        }
    }

    public function if_product_not_stock()
    {
        global $product;

        if ($product->get_price() == '') {
            echo '<p class="stock out-of-stock">Товар отсутсвует</p>';
        }
    }

    public function jk_related_products_args($args)
    {
        $args['posts_per_page'] = 12; // количество "Похожих товаров"
        return $args;
    }

    public function bottom_part_single_product()
    {
        get_template_part('inc/blocks/recently-viewed-block/render', null, array('items' => @settings('items'), 'block-title' => @settings('block-title'), 'block-number' => @settings('block-number')));
        wp_enqueue_style('recently-viewed-block', get_template_directory_uri() . '/inc/blocks/recently-viewed-block/block.css', array(), 2);
        wp_enqueue_script('recently-viewed-block', get_template_directory_uri() . '/inc/blocks/recently-viewed-block/block.js', array(), 2);

        // get_template_part('inc/blocks/recommendations-block/render', null, array('align' => 'alignfull', 'block-title' => @settings('block-title-form'), 'description' => @settings('description-form'), 'image' => @settings('image-form')));
        // wp_enqueue_style('recommendations-block', get_template_directory_uri() . '/inc/blocks/recommendations-block/block.css', array(), 2);
        // wp_enqueue_script('recommendations-block', get_template_directory_uri() . '/inc/blocks/recommendations-block/block.js', array(), 2);
    }

    /*
     * PAGE-CART
     */

    function empty_cart_btn()
    {

        echo '
        <a class="button empty-cart-btn" href="' . wc_get_cart_url() . '?empty-cart">
            Очистить корзину
        </a>';

    }

    function custom_empty_cart()
    {

        if (isset($_GET['empty-cart'])) {
            WC()->cart->empty_cart();
        }

    }

    public
    function cart_items()
    {
        echo '
<tr>
<th>В избранном</th> <td class="cart-items">' . WC()->cart->get_cart_contents_count() . '</td>
</tr>';
    }

    public
    function custom_wc_cart_price()
    {
        global $product;

        $sale_p = $product->get_sale_price();
        $reg_p = $product->get_regular_price();

        if ('' === $product->get_price()) {
            $price = apply_filters('woocommerce_empty_price_html', '', $this);
        } else if ($product->is_on_sale()) {
            $sale_p = (float)$product->get_sale_price();
            $reg_p = (float)$product->get_regular_price();
            $result = 100 - (($sale_p / $reg_p) * 100);
            $price =
                "<div class='price-wrapper'>
			<h2 class='primary'>" . wc_price($sale_p) . "</h2>
			<div class='price-crossed'>" . wc_price($reg_p) . "
			<div class='desc percent'>" . "-" . round($result) . "%" . "</div>
			</div>
			</div>";
        } else {
            $price = "<h2 class='primary'>" . wc_price($reg_p) . "</h2>";
        }

        echo $price;
    }

    public
    function wc_empty_cart_action()
    {
        if (isset($_GET['empty_cart']) && 'yes' === esc_html($_GET['empty_cart'])) {
            WC()->cart->empty_cart();

            $referer = wp_get_referer() ? esc_url(remove_query_arg('empty_cart')) : wc_get_cart_url();
            wp_safe_redirect($referer);
        }
    }

    public
    function filter_woocommerce_cart_needs_shipping_new($needs_shipping)
    {
        if (is_cart())
            return false;
        return true;
    }

    /*
     * PAGE-CHECKOUT
     */

    public
    function w__woocommerce_update_order_review_fragments($fragments)
    {
        ob_start();
        if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) {
            echo '<div class="need__shipping">';
            do_action('woocommerce_review_order_before_shipping');
            wc_cart_totals_shipping_html();
            do_action('woocommerce_review_order_after_shipping');
            echo '</div>';
        }
        $fragments['.need__shipping'] = ob_get_clean();
        return $fragments;
    }

    public
    function second_place_order_button()
    {
        global $woocommerce;
        $subtotal = $woocommerce->cart->get_subtotal();
        $subtax = $woocommerce->cart->get_subtotal_tax();
        $subtotaltax = $subtotal + $subtax;

        if (GetWCMinPrice() < $subtotaltax) {
            $order_button_text = apply_filters('woocommerce_order_button_text', __("Place order", "woocommerce"));
            echo '<button type="submit" class="button alt btn" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">Оформить заказ</button>';

            wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce');
        } else {
            echo '<div class="button disabled alt btn" name="woocommerce_checkout_place_order" id="place_order">Оформить заказ</button>';

        }

    }

    public
    static function my_counter_regular_price_in_cart($_product, $cart_item)
    {
        ?>
        <?php if ($_product->get_regular_price() !== $_product->get_price()) { ?>
        <div class="amount-regular-crossed">
            <div class="regular-price">
                <?php
                $price_sale = $_product->get_regular_price();
                $price_sale_total = $price_sale * $cart_item['quantity'];

                echo wc_price($price_sale_total);

                $sale_p = (float)$_product->get_sale_price();
                $reg_p = (float)$_product->get_regular_price();
                $result = 100 - (($sale_p / $reg_p) * 100);
                $percent = '<span class="percent">' . '-' . round($result) . '%' . '</span>';
                echo $percent;
                ?>
            </div>
        </div>
    <?php } ?>
        <?php
    }
}