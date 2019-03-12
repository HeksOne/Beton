function menu() {
    $('.menu').toggleClass('is-active');
    $('body').toggleClass('active-menu');
    $('.menu-box').toggleClass('active');
    $('.menu-overlay').toggleClass('active');
}

$('.spoiler-body').hide();
$('.spoiler-title').click(function () {
    $(this).toggleClass('opened').toggleClass('closed').prev().slideToggle();
    if ($(this).hasClass('opened')) {
        $(this).html('Скрыть');
    } else {
        $(this).html('Показать все марки');
    }
});

$('.drop').click(function () {
    $(this).toggleClass('opened').toggleClass('closed').next().slideToggle();
});

$("input[type='tel']").mask("+375(99) 99-99-999");


$(function () {
    var owl = $('.owl-carousel1');
    owl.owlCarousel({
        autoplay: false,
        items: 1,
        nav: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        onInitialized: counter, //When the plugin has initialized.
        onTranslated: counter //When the translation of the stage has finished.
    });

    function counter(event) {
        var element = event.target; // DOM element, in this example .owl-carousel
        var items = event.item.count; // Number of items
        var item = event.item.index + 1; // Position of the current item
        $('#counter').html("" + item + "/" + items)
    }
});


$("#contact-form").submit(function () {
    var form = $(this);
    var error = false;

    if (!error) {
        var data = form.serialize();
        $.ajax({
            type: "POST",
            url: "http://cleancar.moonway.by/mail.php",
            dataType: 'json',
            data: data,
            beforeSend: function (data) {
                form.find('input[type="submit"]').attr("disabled", "disabled");
            },
            success: function (data) {
                // if (data["error"]) {
                //     alert(data["error"]);
                // } else {}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // alert(xhr.status);
                // alert(thrownError);
            },
            complete: function () {
                // form.find('input[type="submit"]').prop('disabled', false);
                alert("Сообщение удачно отправлено!")
            }
        });
    }
    return false;
});

$('.owl').owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    nav:false,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 1,
            nav: false
        },
        1000: {
            items: 1,
            nav: true,
            loop: false
        }
    }
});

$('.owl1').owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    nav:false,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 1,
            nav: false
        },
        1000: {
            items: 1,
            nav: true,
            loop: false
        }
    }
})