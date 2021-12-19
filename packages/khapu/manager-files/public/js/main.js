$(document).ready(function() {
    $(".btn-bars").click(function() {
        $(this).toggleClass("active");
    });
    $(".menu-bars>span").click(function() {
        if ($(this).hasClass("title")) {
            $(".sct").removeClass("large-icon");
            $(".sct").addClass("title");
        } else if ($(this).hasClass("large-icon")) {
            $(".sct").addClass("large-icon");
            $(".sct").removeClass("title");
        } else if ($(this).hasClass("details")) {
            $(".sct").removeClass("large-icon");
            $(".sct").removeClass("title");
        }
    });
    if ($(window).width() < 1025) {
        $(".hl-bottom .hl-item .btn-down").click(function() {
            let parents = $(this).parents(".hl-item")
            if (parents.hasClass("active")) {
                parents.children(".hl-submenu").removeClass("active");
                parents.removeClass("active");
            } else {
                $(".hl-item").removeClass("active");
                $(".hl-item .hl-submenu").removeClass("active");
                parents.addClass("active");
                parents.children(".hl-submenu").addClass("active");
            }
        });
    }
    $("#inputCheckAll").change(function() {
        $(".content-sct input:checkbox").not(this).prop('checked', this.checked);
    })
    $(".grct-folder .btn-show").click(function() {
        $(this).parents(".item-folder").children(".folder-submenu").slideToggle();
        $(this).toggleClass("active")
    })
    $(".item-file .btn-dots").click(function() {
        $(this).toggleClass("active")
        $(this).parents(".item-file .dots").children(".dots-submenu").slideToggle()
    })
    $(".item-file .img").click(function() {
        $(".popup-image").toggleClass("active")
        let srcImg = $(this).children("img").attr('src')
        $('.popup-image .content img').attr('src', srcImg)
    })
    $(".close-popup").click(function() {
        $(this).parents(".popup").removeClass("active")
    })
    $(".popup .bg-black").click(function() {
        $(this).parents(".popup").removeClass("active")
    })
    if ($('.item-file').height() > 0) {
        let width = $('.item-file .img').width()
        let height = Number(width) * 3 / 4;
        $('.item-file .img').css({
            'height': height
        })
    }
});