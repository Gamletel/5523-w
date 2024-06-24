<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Company
 */

$logo = theme('logo');
$phones = @settings('phones');
$emails = @settings('emails');
$additional = @settings('additional');
$requisites = @settings('requisites');
?>

<footer id="footer" class="site-footer">
    <div class="footer">
        <div class="footer__top">
            <div class="container">
                <div class="footer__top-wrapper">
                    <div class="menu">
                        <div class="menu__title">
                            Меню
                        </div>

                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footMenu',
                            'container' => false,
                            'menu' => 'Меню-футер',
                            'menu_class' => 'footer-menu',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 2,
                        ]);
                        ?>
                    </div>

                    <div class="menu">
                        <div class="menu__title">
                            Каталог
                        </div>

                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footCatalog',
                            'container' => false,
                            'menu' => 'Меню-каталог',
                            'menu_class' => 'footer-menu',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 2,
                        ]);
                        ?>
                    </div>

                    <div class="menu">
                        <div class="menu__title hidden">
                            Доп каталог
                        </div>

                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footCatalog',
                            'container' => false,
                            'menu' => 'Меню-каталог-доп',
                            'menu_class' => 'footer-menu',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 2,
                        ]);
                        ?>
                    </div>

                    <?php if ($requisites) { ?>
                        <div class="menu">
                            <div class="menu__title">
                                Реквизиты
                            </div>

                            <div class="requisites">
                                <?= $requisites; ?>
                            </div>
                        </div>
                    <?php } ?>


                    <div class="contacts">
                        <?php if ($logo) { ?>
                            <a href="/" class="logo">
                                <h2 class="title">
                                    <?= $logo; ?>
                                </h2>
                            </a>
                        <?php } ?>

                        <?php if ($phones) { ?>
                            <a href="tel:<?= $phones[0]['value']; ?>" class="phone">
                                <h3>
                                    <?= $phones[0]['value']; ?>
                                </h3>
                            </a>
                        <?php } ?>

                        <?php if ($emails) { ?>
                            <a href="mailto:<?= $emails[0]['value']; ?>" class="email">
                                <h4>
                                    <?= $emails[0]['value']; ?>
                                </h4>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-wrapper">
                    <a href="/privacy-policy" class="policy">Политика конфиденциальности</a>

                    <a href="https://grampus-studio.ru/?utm_source=client&utm_keyword=<?= get_site_url(); ?>;"
                       class="developer-link" target="_blank">
                        <span>Сайт разработан</span> GRAMPUS
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="modal-callback" class="theme-modal">
    <div class="close-modal">×</div>
    <div class="form__holder"></div>
</div>

<div id="modal-review" class="theme-modal">
    <div class="close-modal">×</div>
    <div class="form__holder">
        <?= get_form('review'); ?>
    </div>
</div>

<div id="modal-success" class="theme-modal">
    <div class="close-modal">×</div>
    <div class="title">
        Спасибо!
    </div>
    <div class="subtitle">
        Ваша заявка отправлена
    </div>
</div>
<div id="modal-error" class="theme-modal">
    <div class="close-modal">×</div>
    <div class="title">
        Ошибка!
    </div>
    <div class="subtitle">
        Во время отправки произошла ошибка, пожалуйста, попробуйте позже!
    </div>
</div>

<?php wp_footer(); ?>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
</html>