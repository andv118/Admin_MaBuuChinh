var timeOut;
$(document).ready(function () {

    // ajaxJson();
    

    $('.MBC-button').click(function () {
        clickTimKiem();
    });
    $('#mbc-list li').on('click', function () {
        clickTimKiem();
    });

    // Hover thi set text cho input
    $('ul#mbc-list li').hover(function () {
        var text = $(this).text();
        $("input:text").val(text);
    });

    // luc bo ban phim ra
    var keyUp = $('.MBC-input-search').keyup(function () {
        stopLoadJson();
        getLengthInput();
    });

    // luc nhan ban phim xuong
    var keyDown = $('.MBC-input-search').keydown(function () {
        loadJson();
        // getLengthInput();
    });

})

function loadJson() {
    var timeOut = setTimeout(function () {
        var data = $('input[name="input_timKiem"]').val();
        console.log(data);
        $.ajax({
            // beforeSend: , : cho trc khi gui du lieu len
            type: 'POST',
            url : '/handleAjax',
            data: {value: data},
            success: function (e) {
                alert(e);
                // console.log(e);
            },
            error: function (params1, params2, params3) {
                console.log(params3);
            }
        });
    }, 300);
}

function stopLoadJson() {
    clearTimeout(timeOut);
}

function getLengthInput() {
    // get length text input
    var inputLength = $("input:text").val().length;
    if (inputLength < 1) {
        $('.danh-sach-mbc').hide();
        $('#download-mbc').show();
    } else {
        $('.danh-sach-mbc').show();
        $('#download-mbc').hide();
    }
}

function clickTimKiem() {
    $('.logo').hide();
    $('.TitleMBC').hide();
    $('.tim-kiem-input').css('margin-top', '25px');
    //$("input:text").val("dang test");
    $('.danh-sach-mbc').hide();

    var data = $('input[name="input_timKiem"]').val();
    // alert(data);
    $.ajax({
        // beforeSend: , : cho trc khi gui du lieu len
        type: 'POST',
        url : {{ route('search') }},
        data: {value: data},
        success: function (e) {
            alert(e);
        },
        error: function (params1, params2, params3) {
            console.log(params3);
        }
    });
}



// function ajaxJson() {
//     var ourRequest = new XMLHttpRequest();
//     var url = 'https://learnwebcode.github.io/json-example/animals-1.json';
//     ourRequest.open('GET', url);
//     ourRequest.onload = function () {

//         var outData = JSON.parse(ourRequest.responseText);

//         console.log(outData[0]);
//     }
//     ourRequest.send();
// }







