<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $woocommerce;
$subtotal = $woocommerce->cart->get_subtotal();
$subtax = $woocommerce->cart->get_subtotal_tax();
$subtotaltax = $subtotal + $subtax;
?>

<?php if (GetWCMinPrice() < $subtotaltax) { ?>
    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
       class="btn checkout-button button alt wc-forward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
        <?php esc_html_e('Proceed to checkout', 'woocommerce'); ?>
    </a>
<?php } else { ?>
    <div class="btn disabled checkout-button button alt wc-forward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
        <?php esc_html_e('Proceed to checkout', 'woocommerce'); ?>
    </div>
<?php } ?>

