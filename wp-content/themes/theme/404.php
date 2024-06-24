<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme
 */
$page_404_text = theme('page_404_text');

get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <div class="page-404">
                <div class="page-404__title">
                    404
                </div>

                <h4>
                    Ой! Что то пошло не так. Вернитесь на главную страницу
                </h4>
                
                <?php if ($page_404_text) {?>
                    <div class="page-404__text">
                        <?= $page_404_text; ?>
                    </div>
                <?php } ?>

                <div class="page-404__btns">
                    <a href="/shop" class="btn">В каталог</a>

                    <a href="/" class="btn">На главную страницу</a>
                </div>
            </div>
        </div>
    </main>

<?php
get_footer();
