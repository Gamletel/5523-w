<?php

include_once 'functions.php';

class WooThemeHooks extends WooThemeFunctions
{
    function __construct()
    {
        $this->register();
    }

    private function register()
    {
//        /*
//         * WC GLOBAL
//         */
//
        function set_user_visited_product_cookie()
        {
            global $post;

            if (is_product()) {
                // manipulate your cookie string here, explode, implode functions
                wc_setcookie('woocommerce_recently_viewed', $post->ID);
            }
        }

        add_action('template_redirect', [$this, 'truemisha_recently_viewed_product_cookie'], 20);


        add_action('wp', 'set_user_visited_product_cookie');

        add_filter('woocommerce_enqueue_styles', '__return_empty_array'); // Убираем стили woocommerce
        add_filter('woocommerce_add_to_cart_fragments', [$this, 'wc_refresh_mini_cart_count']); //Обновление счетчика товаров в козине
//        add_action('widgets_init', [$this, 'register_my_widgets']); // Регистрация сайдбаров
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); // Убираем оболочку WooCommerce
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); // Убираем оболочку WooCommerce
//
//        /*
//         * CATEGORY-CARD
//         */
//
        add_filter('subcategory_archive_thumbnail_size', [$this, 'theme_catalog_size']); //Возвращаем категориям полным размер изображений
        add_filter('woocommerce_subcategory_count_html', [$this, 'remove_count']); // Удаляем количество товаров в категории
//        add_action('woocommerce_before_subcategory_title', [$this, 'category_image_wrapper'], 10); // Добавляем оболочку для картинки категории
//        add_action('woocommerce_before_subcategory_title', [$this, 'custom_category_top_part'], 5); // Добавляем вернхнюю часть карточки категории
//        add_action('woocommerce_before_subcategory_title', [$this, 'custom_category_see_more_btn'], 15); // Добаввляем кнопку подробнее
//        remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10); // Удаляем картинку без оболочки
//        remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10); // Удаляем картинку без оболочки
//        remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10); // Убираем заголовок

        /*
         * ARCHIVE-PRODUCT
         */

//        add_filter('loop_shop_per_page', function ($cols) {
//            return 12;
//        }, 20); // Выводим только 12 товаров на странице
//        add_action('custom_action_place_for_content', 'woocommerce_pagination', 15); // Переносим пагинацию
//        add_action('custom_action_place_for_content', [$this, 'custom_content_after_archive_products'], 15); // Переносим блоки вниз
        remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10); // Убираем сообщения Woo
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20); // Убираем счетчик товаров в каталоге
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30); // Убираем сортировку товаров в каталоге
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); // Убираем хлебные крошки
        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10); // Переносим пагинацию
        remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10); // Переносим блоки вниз
//
//        /*
//         * PRODUCT-CARD
//         */
//
        add_filter('woocommerce_loop_add_to_cart_args', [$this, 'wp_kama_woocommerce_loop_add_to_cart_args_filter'], 10, 2); // Кастомизирум кнопку добавить в корзину
        add_filter('woocommerce_product_single_add_to_cart_text', [$this, 'tb_woo_custom_cart_button_text']);//Кастомная кнопка Добавить в корзину
        add_filter('woocommerce_product_add_to_cart_text', [$this, 'tb_woo_custom_cart_button_text']); //Меняем тект кнопки Добавить в корзину
        add_action('woocommerce_before_shop_loop_item_title', [$this, 'custom_template_loop_product_thumbnail'], 10); // Добавляем картинку товара в обертке
        add_action('woocommerce_after_shop_loop_item', [$this, 'custom_link'], 15); // Информация о товаре
        add_filter('woocommerce_get_price_html', [$this, 'wp_kama_woocommerce_get_price_html_filter'], 10, 2); //Меняем вывод цены

        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10); // Убираем распродажа из карточки товара
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10); // Убираем обычную картинку товара
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10); // Удаляем обычный вывод цены
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10); // Убираем кнопку добавить к корзину
//        add_action( 'woocommerce_shop_loop_item_title', 'wp_kama_woocommerce_shop_loop_item_title_action' ); //Добавялем артикул товара
//
//        /*
//         * PAGE-FAVORITES
//         */
//
//        add_action('wp_ajax_updatefavorites', [$this, 'updateFavorites']); // Обновление избранного
//        add_action('wp_ajax_nopriv_updatefavorites', [$this, 'updateFavorites']); // Обновление избранного
//        add_action('init', [$this, 'wc_clear_favorite_url']); // Чистка избранного
//
        /*
         * PRODUCT-PAGE
         */


//        add_filter('woocommerce_output_related_products_args', [$this, 'jk_related_products_args']); // Увеличиваем количество похожих товаров
        add_action('woocommerce_single_product_summary', [$this, 'custom_single_product_top_summary'], 3); // Собираем правую часть в карточке товара
        add_action('woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price', 10); // Переносим цену товара
        add_action('woocommerce_single_product_summary', [$this, 'if_product_not_stock'], 25); // Если цены нет, то выводим информационное поле
        add_action('woocommerce_after_single_product_summary', [$this, 'bottom_part_single_product'], 25); // Добавляем нижнюю часть карточки товара
//        add_filter('woocommerce_before_add_to_cart_button', [$this, "wp_kama_woocommerce_before_add_to_cart_button_action"]); //Изменение формата стоимости товара
//        // add_filter( 'woocommerce_format_sale_price', 'wp_kama_woocommerce_format_sale_price_filter', 10, 2 ); //Кастомное отображение скидки товара
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20); //Отключаем похожие товары
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10); // Убираем распродажа в карточке товара
        remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10); //Убираем сообщения в карточке товара
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5); //Переносим заголовок карточки товара
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40); //Удаляем категории из карточки товара
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10); //Переносим цену товара
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15); //Отключаем upsells
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10); //Отключаем табы в карточке товара
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20); //Убираем краткое описание
        remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20); // Убираем Thubms слайдер
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5); // Убираем Заголовок

        /*
         * PAGE-CART
         */

        function sv_change_product_price_cart($price, $cart_item, $cart_item_key)
        {
            $product = wc_get_product($cart_item['product_id']);
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

        add_filter('woocommerce_cart_item_price', 'sv_change_product_price_cart', 99, 3);

        add_action('woocommerce_cart_totals_before_order_total', [$this, 'cart_items']); //Добавляем отображение количества товаров в корзине
        add_action('wp_loaded', [$this, 'wc_empty_cart_action'], 20); // Обработчик кнопки "очистить корзину"
        add_action('empty_cart_hook', [$this, 'empty_cart_btn']);//Добавляем кнопку полной очистки корзины
        add_action('init', [$this, 'custom_empty_cart']);//Обработчик нажатия на кнопку полной очистки корзины
        add_filter('woocommerce_cart_needs_shipping', [$this, 'filter_woocommerce_cart_needs_shipping_new']); // Отключаем учет доставки в корзине
        remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10); //Убираем сообщение
        remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10); //Убираем продвигаемые товары в корзине

        /*
         * PAGE-CHECKOUT
         */
        add_action('woocommerce_review_order_before_order_total', [$this, 'cart_items']); //Добавляем отображение количества товаров в корзине
        add_filter('woocommerce_update_order_review_fragments', [$this, 'w__woocommerce_update_order_review_fragments'], 15, 2); // Обновления фрагментов
        add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20);
        add_action('woocommerce_checkout_order_review', [$this, 'second_place_order_button'], 10); // Перенос кнопки подтвердить заказ
        remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20); // Убираем доставку из order_review
        remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10); // Удаляем сообщения
        remove_action('woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10);
    }
}

return new WooThemeHooks();