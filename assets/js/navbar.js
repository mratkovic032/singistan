$(document).ready(function() {
    //skrol efekat
    $(document).scroll(function() {
        var scroll_pos = $(document).scrollTop() + 100;
        //posle koliko ce da krene sa menjanem css propertija
        if ($(window).width() > 980) {
            if (scroll_pos > 250) {            
                $('.navbar').css({'height': '61px', 'border-bottom': '1px solid #FDC600'});
                $('#nav_div').css({'padding-top': '0px'});
                $('.main-nav').css({'padding-top': '0px'});
                $('.button.navbar-right').css({'padding-top': '0px'});
                $('.navbar_link').addClass('changed');
                $('#big_logo').css({'margin-top': '-100px', 'opacity': '0'});
                $('#small_logo').css({'margin-top': '10px', 'opacity': '1'});
                $('#navigation').css({'height': '58px !important'});
            } else {
                $('.navbar').css({'height': '100px', 'border-bottom': 'none'});
                $('#nav_div').css({'padding-top': '15px'});
                $('.main-nav').css({'padding-top': '10px'});
                $('.button.navbar-right').css({'padding-top': '10px'});
                $('.navbar_link').removeClass('changed');
                $('#big_logo').css({'margin-top': '0px', 'opacity': '1'});
                $('#small_logo').css({'margin-top': '-100px', 'opacity': '0'});
            }
        }
        if ($(window).width() <= 979 && $(window).width() >= 768) {
            if (scroll_pos > 250) {            
                $('.navbar').css({'height': '60px', 'border-bottom': '1px solid #FDC600'});
                $('#nav_div').css({'padding-top': '0px'});
                $('.main-nav').css({'padding-top': '0px'});
                $('.button.navbar-right').css({'padding-top': '0px'});
                $('.navbar_link').addClass('changed');                
                $('#big_logo').css({'margin-top': '-100px', 'opacity': '0'});
                $('#small_logo').css({'margin-top': '10px', 'opacity': '1'});            
            } else {
                $('.navbar').css({'height': '100px', 'border-bottom': 'none'});
                $('#nav_div').css({'padding-top': '15px'});
                $('.main-nav').css({'padding-top': '4px'});
                $('.button.navbar-right').css({'padding-top': '10px'});
                $('.navbar_link').removeClass('changed');
                $('#big_logo').css({'margin-top': '0px', 'opacity': '1'});
                $('#small_logo').css({'margin-top': '-100px', 'opacity': '0'});
            }
        }
        if ($(window).width() < 768) {
            if (scroll_pos > 250) { 
                
                $('.navbar').css({'height': '60px', 'border-bottom': '1px solid #FDC600'});
                $('#nav_div').css({'padding-top': '0px'});
                $('.main-nav').css({'padding-top': '0px'});
                $('.button.navbar-right').css({'padding-top': '0px'});
                $('.navbar_link').addClass('changed');
                $('#big_logo').css({'margin-top': '-100px', 'opacity': '0'});
                $('#small_logo').css({'margin-top': '20px', 'opacity': '1'});            
            } else {
                $('button.navbar-toggle').css({'margin-top': '20px'});
                $('.navbar').css({'height': '100px', 'border-bottom': 'none'});
                $('#nav_div').css({'padding-top': '15px'});
                $('.main-nav').css({'padding-top': '10px'});
                $('.button.navbar-right').css({'padding-top': '10px'});
                $('.navbar_link').removeClass('changed');
                $('#big_logo').css({'margin-top': '10px', 'opacity': '1'});
                $('#small_logo').css({'margin-top': '-100px', 'opacity': '0'});
            }
        }
    });
});