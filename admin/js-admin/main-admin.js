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
    // add category shop
    $(".btn-add-shop-category").click(function () {
        $(".form-add-category-shop").fadeIn(500);
    })
    $(".close-add").click(function () {
        $(".form-add-category-shop").fadeOut(500);
    })
    //  add shop
    $(".btn-add-shop1").click(function () {
        $(".show-pet-shop-add").fadeIn(500);
    })
    $(".close-add").click(function () {
        $(".show-pet-shop-add").fadeOut(500);
    })
});fform-add-pet-shop
//edit slide
function ImageFileAsUrlEditSlider() {
    var fileSelected = document.getElementById("edit-img-slider").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-image").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};

//add slide
function ImageFileAsUrlAddSlider() {
    var fileSelected = document.getElementById("add-img-slider").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-slider-add").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};

//add shop
function ImageFileAsUrlAddShop() {
    var fileSelected = document.getElementById("add-id-shop-image").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-shop-image-chil").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};

//Edit shop
function ImageFileAsUrlEditShop() {
    var fileSelected = document.getElementById("img-input-pet-shop").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-edit-un-shop-show").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
//add category shop
function ImageFileAsUrlAddCategory() {
    var fileSelected = document.getElementById("add-categoy-img-slider").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-add-categoy-slider").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
//edit category shop
function ImageFileAsUrlEditCategory() {
    var fileSelected = document.getElementById("edit-categoy-img-slider").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-edit-categoy-slider1").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
//add sevice
function ImageFileAsUrlAddSevice() {
    var fileSelected = document.getElementById("add-id-image").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-seviec-image").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
// edit sevice
function ImageFileAsUrlEditSevice() {
    var fileSelected = document.getElementById("img-input-sevice2").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-edit-un-sevice-show").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
// add news
function ImageFileAsUrlAddNews() {
    var fileSelected = document.getElementById("add-id-news-image").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-news-image-chil").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
// edit news
function ImageFileAsUrlEditNews() {
    var fileSelected = document.getElementById("edit-id-news-image").files;
    console.log(fileSelected.length);
    if (fileSelected.length > 0) {
        for (var i = 0; i < fileSelected.length; i++) {
            var fileToLoad = fileSelected[i];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.createElement("img");
                newImage.src = srcData;
                document.getElementById("display-news-image-chil-edit").innerHTML += newImage.outerHTML;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
};
