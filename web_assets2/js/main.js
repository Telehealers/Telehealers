(function($) {
    var newproducts = $("#Home_slider");
    newproducts.owlCarousel({ autoplay: true, nav: true, smartSpeed: 1000, dots: true, margin: 0, loop: true, navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'], responsiveClass: true, responsive: { 0: { items: 1, }, 575: { items: 1, }, 991: { items: 1, }, 992: { items: 1, } } });
 
    var newproducts = $("#home_main_slider");
    newproducts.owlCarousel({ autoplay: true, nav: false, animateIn: 'fadeIn', smartSpeed: 1000, dots: false, margin: 0, loop: true, navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'], responsiveClass: true, responsive: { 0: { items: 1, }, 575: { items: 1, }, 991: { items: 1, }, 992: { items: 1, } } });

    var newproducts = $("#home_testimonail_slider");
    newproducts.owlCarousel({ autoplay: true, nav: false, animateIn: 'fadeIn', mouseDrag: false, smartSpeed: 1000, dots: true, margin: 20, loop: true, responsiveClass: true, responsive: { 0: { items: 1, }, 575: { items: 1, }, 991: { items: 1, }, 992: { items: 1, } } });
	
	var newproducts = $("#home_faq_slider");
    newproducts.owlCarousel({ autoplay: true, nav: false, animateIn: 'fadeIn', mouseDrag: false, smartSpeed: 1000, dots: true, margin: 20, loop: true, responsiveClass: true, responsive: { 0: { items: 1, }, 575: { items: 1, }, 991: { items: 2, }, 992: { items: 2, } } });

    var newproducts = $("#home_publication_slider");
    newproducts.owlCarousel({ autoplay: true, nav: true, animateIn: 'fadeIn', mouseDrag: false, smartSpeed: 1000, dots: true, margin: 20, loop: true, navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow"></i>'], responsiveClass: true, responsive: { 0: { items: 1, }, 575: { items: 1, }, 991: { items: 1, }, 992: { items: 1, } } });



    $(window).scroll(function() {
        var sticky = $('.menubar'),
            scroll = $(window).scrollTop();

        if (scroll >= 300) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
    });


    $(document).ready(function() {
        $("#openSidebarMenu").click(function() {
            $("#custom_menu").slideToggle();
        });
    });



    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-item");
    const $dropdownMenu = $(".dropdown-content");
    const showClass = "show";

    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 991px)").matches) {
            $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    $(".dropdown-toggle").click(function() {
        $(this).parent().find("ul").toggle('slow');
    });


})(jQuery);