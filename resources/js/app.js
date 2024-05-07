import './bootstrap';


function slider() {
    let banner = document.getElementById("bannerArea");

    banner.firstElementChild.classList.add("is-active");

    let bannerItem = banner.getElementsByTagName("div");

    //子要素の数をカウント
    let num = banner.childElementCount;

    let dot_wrap = document.getElementById("bannerDot");
    let dot = dot_wrap.getElementsByTagName('li');

    let li = [];
    for (let i = 0; i < num; i++) {
        li.push(document.createElement("li"));
        dot_wrap.appendChild(li[i]);
    }
    dot_wrap.firstElementChild.classList.add("active");

    let cur_index = 0;
    function count_index() {
        cur_index++;
        if (cur_index === num) {
            cur_index = 0;
        }
    }

    function click_dot() {
        for (let j = 0; j < num; j++) {
            dot[j].addEventListener("click", function () {
                dot[cur_index].classList.remove("active");
                dot[j].classList.add("active");

                bannerItem[cur_index].classList.remove("is-active");
                bannerItem[j].classList.add("is-active");

                cur_index = j;
            });
        }
    }

    function fade_infinite() {
        count_index();
        let rm_index = (cur_index == 0 ? num - 1 : cur_index - 1);

        bannerItem[rm_index].classList.remove("is-active");
        bannerItem[cur_index].classList.add("is-active");

        dot[rm_index].classList.remove("active");
        dot[cur_index].classList.add("active");
        click_dot(cur_index);
    }

    const sec = 3000;
    let timer;
    function start_timer() {
        timer = setInterval(fade_infinite, sec);
    }
    start_timer();

    function stop_timer() {
        clearInterval(timer);
    }

    for (let k = 0; k < num; k++) {
        bannerItem[k].addEventListener("mouseover", () => {
            stop_timer();
        });
        bannerItem[k].addEventListener("mouseleave", () => {
            start_timer();
        });
    }
};

if (document.getElementById("bannerArea")) {
    slider();
};

$(function deleteDeliveryTime() {
    $(document).on('click', '.delete-delivery-time', function () {
        let deleteConfirm = confirm('本当に削除しますか？');

        if (deleteConfirm == true) {
            let clickElement = $(this);
            let userId = clickElement.attr('id');

            $.ajax({
                url: '../delivery_time_delete/' + userId,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    'id': userId,
                    '_method': 'DELETE'
                },
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
                clickElement.parents('.delivery-time').remove();
            }).fail(function () {
                //ajax通信がエラーのときの処理
                console.log('通信に失敗しました。');
            });
        } else {
            (function (e) {
                e.preventDefault()
            });
        }
    })
})

$(function removeDeliveryTime() {
    $(document).on('click', '.remove-delivery-time', function () {
        let removeConfirm = confirm('本当に削除しますか？');

        if (removeConfirm == true) {
            let removeElement = $(this);
            removeElement.parents('.delivery-time').remove();
        }
    })
})

$(function addDeliveryTime() {
    $(document).on('click', '#addDeliveryTime', function () {
        var lastFormId = $('input[name="delivery_time_id[]"]:last').val();
        $.ajax({
                url: '../delivery_time_add',
                type: 'GET',
                data: {
                    'last_id': lastFormId,
                },
                dataType: 'json',
        }).done(function (data) {
            let deliveryTimeLastId = data.delivery_time_last_id.id;
            if (deliveryTimeLastId < lastFormId) {
                deliveryTimeLastId = lastFormId;
            }
            deliveryTimeLastId++;
            let addDeliveryTimeForm =
                `<div class="delivery-time">
                <input type = "hidden" name = "delivery_time_id[]" value = "${deliveryTimeLastId}" >
                <input type="date" name="date_from[]" class="date-from" value="" placeholder="年月日" required>
                <input type="time" name="time_from[]" class="time-from" value="" placeholder="日時" required>
                <p>～</p>
                <input type="date" name="date_to[]" class="date-to" value="" placeholder="年月日" required>
                <input type="time" name="time_to[]" class="time-to" value="" placeholder="日時" required>
                <div class="remove-delivery-time"></div>
                </div>`;
                $(addDeliveryTimeForm).appendTo('#deliveryTimeSetting').hide().fadeIn(300);
            }).fail(function () {
                //ajax通信がエラーのときの処理
                console.log('通信に失敗しました。');
            });
    })
})

if (document.getElementById("deliveryTimeSetting")) {
    $('input.date-from').map(function (index, element) {
        $(this).blur(function () {
            if ($(this).val()) {
                $(this).attr('placeholder', '');
            } else {
                $(this).attr('placeholder', '年月日');
            }
        })

        return $(this).val();

        // console.log(dateFrom.val());
        // console.log((dateFrom).attr('placeholder'));
    }).get();



    let timeFrom = $('input.time-from').map(function (index, element) {
        return $(this).val();
    }).get();

    let dateTo = $('input.date-to').map(function (index, element) {
        return $(this).val();
    }).get();

    let timeTo = $('input.time-to').map(function (index, element) {
        return $(this).val();
    }).get();


    // $('input.date-from').on('blur', function () {
    //     if (dateFrom.val() == "") {
    //         alert('入力されています。');
    //     } else {
    //         alert('入力されていません。');
    //     }
    // });


    // let dateFrom = new Date(inputText).getFullYear();
    // let dateTo = new Date(inputTo).getMonth() + 1;
// $('input[name="date-from[]"]').val(dateTo);
}

var dt = new Date();
var y = dt.getFullYear();
var m = ("00" + (dt.getMonth()+1)).slice(-2);
var d = ("00" + (dt.getDate())).slice(-2);
var result = y + m + d;
