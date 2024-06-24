// Изменение количества товаров в корзине
var tct = null;

function cChangeValue(iid, m) {
    var i = jQuery('#' + iid);
    var cv = i.val();
    if (m == 1) {
        cv--;
        i.val(cv);
    }
    if (m == 0) {
        cv++;
        i.val(cv);
    }
    if (tct) {
        var q = tct;
        clearTimeout(q);
    }
    tct = setTimeout(function () {
        i.trigger('change');
        clearTimeout(tct);
    }, 500);
}

jQuery(document).ready(function ($) {
    console.log('test');
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);


    //Обрезаем комментарии на архивной странице
    let reviews = $('.archive-reviews .archive__item');

    reviews.each(function () {
        const text = $(this).find('.review__text');
        const readmoreBtn = $(this).find('.readmore');
        readmoreBtn.hide();

        if (text.height() > 130) {
            text.addClass('hided');
            readmoreBtn.show().click(() => {
                    text.toggleClass('hided')
                }
            );
        }
    })

    // PRODUCT-SWIPER
    let swiperMainSingleProduct = new Swiper('.swiper-woocommerce-single-product', {
        // autoplay: {
        // 	delay: 5000,
        // },
        slidesPerView: 1,
        spaceBetween: 30,

        navigation: {
            nextEl: '.thumbnails-wrapper .swiper-btn-next',
        },

        thumbs: {
            swiper: {
                el: '.swiper-woocommerce-single-product-thumbnails',
                slidesPerView: 3,
                direction: 'horizontal',
                spaceBetween: 30,
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 2,
                    },
                    425: {
                        slidesPerView: 3,
                    },
                    // when window width is >= 480px
                    993: {
                        slidesPerView: 6,
                    },
                    // when window width is >= 640px
                    1240: {
                        slidesPerView: 3,
                    }
                }
            }
        }
    });

    // Обрезаем характеристики при необходимости
    const vars = $('.type-product .product__info .woocommerce-product-attributes-item');
    const showAllVarsBtn = $('.type-product .product__info #show-all-vars-btn');
    let isOpened = false;

    showAllVarsBtn.click(() => {
        switch (isOpened) {
            case true:
                vars.each(function (id) {
                    if (id > 5) {
                        $(this).hide();
                    }
                });
                showAllVarsBtn.text('Все характеристики');
                isOpened = !isOpened;
                break;

            case false:
                vars.each(function () {
                    $(this).show();
                });
                showAllVarsBtn.text('Скрыть');
                isOpened = !isOpened;
                break;

            default:
                break;
        }

    });
    showAllVarsBtn.hide();

    if (vars.length > 5) {
        showAllVarsBtn.show();
        vars.each(function (id) {
            if (id > 5) {
                $(this).hide();
            }
        });
    }

    $('input[type=tel]').inputmask({"mask": "+7 999 999-99-99"}); //specifying options

    window.formPhoneValidator = function (input) {
        let tempInput = input.toString().replaceAll('_', '');
        tempInput = tempInput.replaceAll(' ', '');
        tempInput = tempInput.replaceAll('-', '');

        return tempInput.length === 12;
    }

    // $(document).scroll(function() {
    //     if ($(this).scrollTop() >= 50) {
    //     $('#header').addClass('painted');
    //     // console.log('scroll')
    //     }else{
    //     $('#header').removeClass('painted');
    //     }
    // });
    //

    // $("li.nav-menu-element a").click(function() { // ID откуда кливаем
    // 	let hash = $(this).attr('href');
    // 	if(hash.length > 1) {
    // 		$(this).parent().addClass('active');
    // 		$(this).parent().siblings().removeClass('active');
    // 		$('html, body').animate({
    //             scrollTop: $(hash).offset().top - 120 // класс объекта к которому приезжаем
    //         }, 1000); // Скорость прокрутки
    // 	}
    // });


    /*============ FUNCTIONS ===========*/

    // function getCallbackForm(modal, props) {
    //     let id = props['data-modal'].value;
    //     if($(modal).find('.form__holder').html() == '') {
    //         $.ajax({
    //             url: `/wp-admin/admin-ajax.php?action=get_modal_form&modal=${id}`,
    //             method: 'GET',
    //             success: function (data){
    //                 $(modal).find('.form__holder').html(data);
    //                 let form = $(modal).find('form').get(0);

    //                 ThemeModal.reinitForms(form);
    //                 ThemeModal.getInstance().openModal(id);
    //             },
    //             error: function (data) {
    //                 ThemeModal.getInstance().openModal('error');
    //             }
    //         });
    //     }else{
    //         ThemeModal.getInstance().openModal(id);
    //     }
    // }

    let mobileMenu = new MobileMenu(); // Вызов объекта класса мобильного меню
    mobileMenu.init(); // Инициализация мобильного меню
    let themeModal = new ThemeModal({}); // Вызов объекта класса модалок

    // themeModal.modalsView['callback'] = {
    // 	callback: getCallbackForm
    // };
    themeModal.init(); // Инициализация модалок

});
