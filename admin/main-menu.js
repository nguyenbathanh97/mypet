$(document).ready(function () {
    $(".down-click").click(function () {
        $(".down-logout").toggle("1500, 0.6");
    })
});


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