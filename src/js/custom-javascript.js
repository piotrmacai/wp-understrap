// Add your JS customizations here
jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { passive: true });
    }
};
jQuery(function($) {
    $(window).on("scroll resize", function() {
        var topoffset = $(window).scrollTop();
        if (topoffset > 0) {
            $("#wrapper-navbar").addClass("sticky");
            $("#mega-menu").addClass("sticky");
        } else {
            $("#wrapper-navbar").removeClass("sticky");
            $("#mega-menu").removeClass("sticky");
        }
    });
    $(".dropdown.dd-sto").on("mouseenter", function() {
        if ($(window).width() > 992) {
            $(".mm-sto").removeClass("show");
            $(".mm-zab").removeClass("show");
            $(".mm-sto").addClass("show");
        }
    });
    $(".dropdown.dd-zab").on("mouseenter", function() {
        if ($(window).width() > 992) {
            $(".mm-sto").removeClass("show");
            $(".mm-zab").removeClass("show");
            $(".mm-zab").addClass("show");
        }
    });
    jQuery("div#frontPage").on("mouseenter", function() {
        jQuery(".mm-sto").removeClass("show");
        jQuery(".mm-zab").removeClass("show");
    });
    $(".label.select").on("click touch", function() {
        $(this).parent().find(".options-wrapper").slideToggle();
    });
    $(".options-wrapper .option").on("click touch", function() {
        var dataval = $(this).attr("data-value");
        var txt = $(this).text();
        $(".options-wrapper").slideToggle();
        $(".current").text("Wybrany zabieg: "+txt);
        $("input#fcsubject").val(dataval);
    });
    $(".conform-form-wrapper .button").on("click touch", function() {
        $(".conform-form-wrapper .response").html("");
        if ($("input#fcacceptance").is(":checked")) {
            var fields = {
                fcname:$("input#fcname").val(),
                fcphone:$("input#fcphone").val(),
                fcemail:$("input#fcemail").val(),
                zabieg:$("input#fcsubject").val(),
            }
            if ($("input#fcname").val().length == 0) {
                $(".conform-form-wrapper .response").html('<p class="error">Imię i nazwisko są wymagane</p>');
            } else if ($("input#fcphone").val().length == 0) {
                $(".conform-form-wrapper .response").html('<p class="error">Numer telefonu jest wymagany</p>');
            } else if ($("input#fcemail").val().length == 0) {
                $(".conform-form-wrapper .response").html('<p class="error">E-mail jest wymagany</p>');
            } else if ($("input#fcsubject").val().length == 0) {
                $(".conform-form-wrapper .response").html('<p class="error">Wybierz zabieg</p>');
            } else {
                var str = $.param( fields );
                window.location.href = "/darmowa-konsultacja?"+str;
            }
        } else {
            $(".conform-form-wrapper .response").html('<p class="error">Zgoda jest wymagana</p>');
        }
    });
    $("#mega-menu").on("mouseleave", function() {
        $(".mm-sto").removeClass("show");
        $(".mm-zab").removeClass("show");
    })
    $(".mm-sto").on("mouseleave", function() {
        $(".mm-sto").removeClass("show");
        $(".mm-zab").removeClass("show");
    })
    $(".mm-zab").on("mouseleave", function() {
        $(".mm-sto").removeClass("show");
        $(".mm-zab").removeClass("show");
    })
    $(document).on("click touch", "li.menu-item-has-children .dropdown-arrow", function(e) {
        var thisel = $(this);
        if (e.target.classList.contains('dropdown-arrow')) {
            e.stopPropagation();
            e.preventDefault();
            if ($(window).width() < 980) {
                thisel.toggleClass("dropped");
                thisel.parent().find("ul.dropdown-menu").toggleClass("dropped");
            }
        }
    });
    if ($(window).width() < 980 && $("header#wrapper-navbar #main-nav div#navbarNavDropdown #main-menu li.menu-item-has-children .dropdown-arrow").length == 0) {
        $("header#wrapper-navbar #main-nav div#navbarNavDropdown #main-menu li.menu-item-has-children").append("<div class='dropdown-arrow'></div>");
    } else {
        $("header#wrapper-navbar #main-nav div#navbarNavDropdown #main-menu li.menu-item-has-children").remove("div.dropdown-arrow");
    };
    $(window).on("resize", function() {
        if ($(window).width() < 980 && $("header#wrapper-navbar #main-nav div#navbarNavDropdown #main-menu li.menu-item-has-children .dropdown-arrow").length == 0) {
            $("header#wrapper-navbar #main-nav div#navbarNavDropdown #main-menu li.menu-item-has-children").append("<div class='dropdown-arrow'></div>");
        } else {
            $("header#wrapper-navbar #main-nav div#navbarNavDropdown #main-menu li.menu-item-has-children").remove("div.dropdown-arrow");
        };
    })
    $("div#toTop").on("click touch", function() {
        $('body,html').animate({
                scrollTop: $('body').offset().top
        }, 500);
    });
    $("a.dropdown-toggle").on("click touch", function(e) {
        e.stopPropagation();
        if ($(this).attr("href").length > 1 && $(window).width() > 992) {
            window.location.href = $(this).attr("href");
        } else if ($(window).width() < 992) {
            window.location.href = $(this).attr("href");
        }
    })
    $("#wrapper-navbar").on("mouseleave", function() {
        if ($(window).width() > 992) {
            $("ul.dropdown-menu.show").removeClass("show");
        }
    })
    jQuery(".q-wrapper").on("click touch", function() {
        jQuery(this).toggleClass("active");
        jQuery(this).parent().find(".a-wrapper").toggleClass("show");
    });
    $("button.navbar-toggler").on("click touch", function() {
        $("header#wrapper-navbar #main-nav div#navbarNavDropdownMobile").toggleClass("show");
    });
    $(".exertions .exertion-nav").on("click touch", function() {
        $(".exertion-nav.active").removeClass("active");
        $(this).addClass("active");
        var id = $(this).attr("data-changeexertion");
        $(".exertion-content.show").removeClass("show");
        $(".exertion-content[data-changeexertion="+id+"]").addClass("show");
    });
    $(".metamorphosis .exertion-nav").on("click touch", function() {
        if ($(this).hasClass("active")) {
            $(this).toggleClass("active");
        } else {
            $(".exertion-nav.active").removeClass("active");
            $(this).toggleClass("active");
        }
        var id = $(this).attr("data-changeexertion");
        if ($(".exertion-nav.active").length > 0) {
            $(".metamorphosis-content.show").removeClass("show");
            $(".metamorphosis-content[data-changeexertion="+id+"]").addClass("show");
        } else {
            $(".metamorphosis-content").addClass("show");
        }
    });
    jQuery(".gallery-toggle").on("click touch", function() {
        var hidden = jQuery(this).find("p.hide");
        var shown = jQuery(this).find("p.show");
        hidden.removeClass("hide").addClass("show");
        shown.addClass("hide").removeClass("show");
        jQuery(this).closest(".example-transformation").find(".container.gallery").slideToggle();
    });
});
