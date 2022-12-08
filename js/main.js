
$(document).ready(function(){
  $('#slide').slick({
    loop: true,
    infinite: true,
    speed: 300,
    autoplay: true,
    autoplaySpeed: 1800,
    slidesToShow: 1,
    adaptiveHeight: true,
    prevArrow: `<button type='button' class='slick-prev pull-left slick-arrow' ><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-next pull-right slick-arrow'><i class="fa-solid fa-chevron-right"></i></button>`,
  });

  $(".register-booking").click(function(){
    $(".form-booking").show();
  })
  $(".booking-close").click(function(){
    $(".form-booking").hide();
  })

  $('.post-service-slide').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1800,
    adaptiveHeight: true,
    prevArrow: `<button type='button' class='slick-prev slick-prev1 pull-left slick-arrow' ><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-next slick-next1 pull-right slick-arrow'><i class="fa-solid fa-chevron-right"></i></button>`,
  });
});

// admin
$(document).ready(function(){
  $(".yes-account").click(function(){
    $(".form-login").show();
    $(".form-register").hide();
  })
  $(".no-account").click(function(){
    $(".form-login").hide();
    $(".form-register").show();
  })
});
// $(document).ready(function(){
//   $('.call').mouseover(function(){
//     $('.call-circle-out').show();
//     $('.img-phone').css({"zoom": "1.3"});
//   })
//   $('.call').mouseleave(function(){
//     $('.img-phone').css({"zoom": "1"});
//     $('.call-circle-out').hide();
//   })
// })


// $(document).ready(function(){
//   $('.click-down').click(function(){
//     $(".down-menu").slideToggle(300,'swing');
//   })
// })
$(document).ready(function () {
  $(window).scroll(function () {
     if($(this).scrollTop()){
      $('.backtop').fadeIn();
     }else{
      $('.backtop').fadeOut();
     }
  });
  $('.backtop').click(function(){
      $('html, body').animate({scrollTop: 0}, 200)
  });
});

