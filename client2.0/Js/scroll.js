$(function(){

  var oHead = $('#head'),
    oHead_main = $('.header-main'),
    oLogo_reg = $('.log-reg'),
    oSearch_hots = $('.search-hots'),
    oLogo=$('.logo'),
    oNav=$('#navbar'),
    oNav_img=$('#navbar img'),
    doc = $(document),
    win = $(window);

  win.scroll(function() {

    if (doc.scrollTop() >120) {
      oHead.addClass('header_scroll');
      oHead_main.addClass('head_main_scroll');
     oLogo_reg.addClass('logo_reg_scroll');
     oSearch_hots.addClass('search_hots_scroll');
     oLogo.addClass('logo_scroll');
      oNav.css('width','80px');
      oNav_img.addClass('nav_img_none');

    } else {
      oHead.removeClass('header_scroll');
      oHead_main.removeClass('head_main_scroll');
       oLogo_reg.removeClass('logo_reg_scroll');
      oSearch_hots.removeClass('search_hots_scroll');
      oLogo.removeClass('logo_scroll');
      oNav.css('width','120px');
      oNav_img.removeClass('nav_img_none')
    
    }

  });

  
  win.scroll();
});