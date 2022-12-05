$(document).ready(function () {
    // add slide
    $(".btn-add-slider").click(function () {
        $(".form-add").fadeIn(500);
    })
    $(".close-add").click(function () {
        $(".form-add").fadeOut(500);
    })
    //infor
    $(".btn-add-infor").click(function () {
        $(".form-add-infor").fadeIn(500);
    })
    $(".close-add").click(function () {
        $(".form-add-infor").fadeOut(500);
    })
     //sevice
     $(".btn-add-sevice").click(function () {
        $("#form-add-sevice").fadeIn(500);
    })
    $(".close-add").click(function () {
        $("#form-add-sevice").fadeOut(500);
    })
    //sevice edit
    $(".close-add").click(function () {
        $("#form-add-sevice-edit").fadeIn(500);
    })
});
CKEDITOR.replace('desc');