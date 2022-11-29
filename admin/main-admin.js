// $(document).ready(function(){
//     $(".yes-account").click(function(){
//       $(".form-login").fadeIn("1500, 0.6");
//       $(".form-register").fadeOut("1500, 0.6");
//     })
//     $(".no-account").click(function(){
//         $(".form-register").fadeIn("1500, 0.6");
//         $(".form-login").fadeOut("1500, 0.6");
//     })
//   });

$(document).ready(function () {
    $('.menu-toogle').click(function () {
        $(this).toggleClass('on');
        if ($('#navigator').css('left') == '-250px') {
            $('#navigator').animate({
                left: '0px'
            }, 400);
            $('.menu-toogle').animate({
                left: '250px'
            }, 400);
            $(".dark").toggleClass("shows");
        } else {
            $('#navigator').animate({
                left: '-250px'
            }, 400);
            $(this).animate({
                left: '0px'
            }, 400);
            $(".dark").removeClass('shows');
        }
    });
});