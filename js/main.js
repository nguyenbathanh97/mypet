
$(document).ready(function () {
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

  $(".register-booking").click(function () {
    $(".form-booking").show();
  })
  $(".booking-close").click(function () {
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
  $('.slider-show-similar-pre').slick({
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
$(document).ready(function () {
  $(".yes-account").click(function () {
    $(".form-login").show();
    $(".form-register").hide();
  })
  $(".no-account").click(function () {
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
    if ($(this).scrollTop()) {
      $('.backtop').fadeIn();
    } else {
      $('.backtop').fadeOut();
    }
  });
  $('.backtop').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 200)
  });
});

// number detail
//<![CDATA[
// $('input.input-qty').each(function () {
//   var $this = $(this),
//     qty = $this.parent().find('.is-form'),
//     min = Number($this.attr('min')),
//     max = Number($this.attr('max'))
//   if (min == 0) {
//     var d = 0
//   } else d = min
//   $(qty).on('click', function () {
//     if ($(this).hasClass('minus')) {
//       if (d > min) d += -1
//     } else if ($(this).hasClass('plus')) {
//       var x = Number($this.val()) + 1
//       if (x <= max) d += 1
//     }
//     $this.attr('value', d).val(d)
//   })
// })
//]]>
$(document).ready(function () {
  $('.down-icon').hover(function () {
    $('.login-down').fadeToggle();
  })
})