  // <**************************************************header-menu-js-start******************************************************************



  (function($) {
     

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


  })(jQuery);

