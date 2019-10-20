$(document).ready(function() {

  var $SIDEBAR_MENU = $('#sidebar-menu');

  $("#menu_toggle").click(function(){

    if ($("BODY").hasClass('nav-md')) {
      $("SIDEBAR_MENU").find('li.active ul').hide();
      $("SIDEBAR_MENU").find('li.active').addClass('active-sm').removeClass('active');
           // $("#Content").css({"margin-left": "3%"});
           $('.desplegable').css('display','none');
         } else {
          $("SIDEBAR_MENU").find('li.active-sm ul').show();
          $("SIDEBAR_MENU").find('li.active-sm').addClass('active').removeClass('active-sm');
          $('.desplegable').css('display','block');
            //$("#Content").css({"margin-left": "12%"});
          }

          $("BODY").toggleClass('nav-md nav-sm');

        });  





  $("#sidebar_menu").find("a").click(function() {

    var $li = $(this).parent();

    if ($li.is('.active')) {
      $li.removeClass('active active-sm');
      $('ul:first', $li).slideUp(function() {

      });
    } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
              $SIDEBAR_MENU.find('li').removeClass('active active-sm');
              $SIDEBAR_MENU.find('li ul').slideUp();
            }
            
            $li.addClass('active');

            $('ul:first', $li).slideDown(function() {

            });
          }
    }); 

  $(".collapse-link").on("click",function(){var a=$(this).closest(".x_panel"),b=$(this).find("i"),c=a.find(".x_content");a.attr("style")?c.slideToggle(200,function(){a.removeAttr("style")}):(c.slideToggle(200),a.css("height","auto")),b.toggleClass("fa-chevron-up fa-chevron-down")})

});