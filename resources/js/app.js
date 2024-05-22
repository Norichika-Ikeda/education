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
                `<div class="delivery-time__form--date">
                <input type = "hidden" name = "delivery_time_id[]" value = "${deliveryTimeLastId}" >
                <input type="date" name="date_from[]" class="date-from" value="" placeholder="年月日" required>
                <input type="time" name="time_from[]" class="time-from" value="" placeholder="日時" required>
                <p>～</p>
                <input type="date" name="date_to[]" class="date-to" value="" placeholder="年月日" required>
                <input type="time" name="time_to[]" class="time-to" value="" placeholder="日時" required>
                <div class="delivery-time__form--remove"></div>
                </div>`;
            $(addDeliveryTimeForm).insertBefore('#addDeliveryTime').hide().fadeIn(300);
        }).fail(function () {
            //ajax通信がエラーのときの処理
            console.log('通信に失敗しました。');
        });
    })
})

// if (document.getElementById("articleSetting")) {
//     $('input.posted-date').map(function (index, element) {
//         $(this).blur(function () {
//             if ($(this).val()) {
//                 $(this).attr('placeholder', '');
//             } else {
//                 $(this).attr('placeholder', '年月日');
//             }
//         })
//         return $(this).val();
//     }).get();
// }


$('input[type="date"]').map(function () {
    $(document).on('blur', 'input[type="date"]', (function () {
        if ($(this).val()) {
            $(this).addClass('is-blank');
            $(this).attr('placeholder', '');
        } else {
            $(this).removeClass('is-blank');
            $(this).attr('placeholder', '年月日');
        }
    })
    )
})

$('input[type="time"]').map(function () {
    $(document).on('blur', 'input[type="time"]', (function () {
        if ($(this).val()) {
            $(this).addClass('is-blank');
            $(this).attr('placeholder', '');
        } else {
            $(this).removeClass('is-blank');
            $(this).attr('placeholder', '日時');
        }
    })
    )
})

$(function deleteArticle() {
    $(document).on('click', '.remove-article', function () {
        let deleteConfirm = confirm('本当に削除しますか？');

        if (deleteConfirm == true) {
            let clickElement = $(this);
            let userId = clickElement.attr('id');

            $.ajax({
                url: 'article_delete/' + userId,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    'id': userId,
                    '_method': 'DELETE'
                },
                dataType: 'json',
            }).done(function (data) {
                clickElement.parents('tr').remove();
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

let bannerImage = document.querySelector(".banner-form");
$(function bannerSelect() {
    $(document).on('click', '.banner-select', function () {
        if ($(this).prev(bannerImage)[0]) {
            $(this).prev(bannerImage)[0].click();
        }
    });
})

$(document).on("change", ".banner-form", function () {
    let elem = this                             //操作された要素を取得
    let fileReader = new FileReader();          //ファイルを読み取るオブジェクトを生成
    fileReader.readAsDataURL(elem.files[0]);    //ファイルを読み取る
    fileReader.onload = (function () {
        if ($(elem).prev('.banner-image').length) {
            $(elem).prev().attr('src', fileReader.result);
        } else {
            $(elem).before('<img src="" alt="" width="200px" height="130px" class="banner-image">');
            $(elem).prev().attr('src', fileReader.result);
        }
    });
})

$(function deleteBanner() {
    $(document).on('click', '.delete-banner', function () {
        let deleteConfirm = confirm('本当に削除しますか？');

        if (deleteConfirm == true) {
            let clickElement = $(this);
            let userId = clickElement.attr('id');

            $.ajax({
                url: 'banner_delete/' + userId,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    'id': userId,
                    '_method': 'DELETE'
                },
                dataType: 'json',
            }).done(function (data) {
                clickElement.parents('.banner').remove();
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

$(function removeBanner() {
    $(document).on('click', '.remove-banner', function () {
        let removeConfirm = confirm('本当に削除しますか？');

        if (removeConfirm == true) {
            let removeElement = $(this);
            removeElement.parents('.banner').remove();
        }
    })
})

$(function addBanner() {
    $(document).on('click', '#addBanner', function () {
        var lastFormId = $('input[name="banner_id[]"]:last').val();
        $.ajax({
                url: 'banner_add',
                type: 'GET',
                data: {
                    'last_id': lastFormId,
                },
            dataType: 'json',
        }).done(function (data) {
            let bannerLastId = data.banner_last_id.id;
            if (bannerLastId < lastFormId) {
                bannerLastId = lastFormId;
            }
            bannerLastId++;
            let addBannerForm =
                `<div class="banner d-flex align-items-center my-4">
                <input type = "hidden" name = "banner_id[]" class="banner-id" value="">
                <input type="file" name="banner[]" class="banner-form " value="" style="display:none">
                <button type="button" name="{{ $banner->id }}" class="banner-select ms-5">ファイルを選択</button>
                <div class="remove-banner ms-5"></div>
                </div>`;
                $(addBannerForm).appendTo('#bannerSetting').hide().fadeIn(300);
            }).fail(function () {
                //ajax通信がエラーのときの処理
                console.log('通信に失敗しました。');
            });
    })
})

let curriculumImage = document.querySelector(".curriculum__form--image--btn");
$(function bannerSelect() {
    $(document).on('click', '.curriculum__form--image--select', function () {
        if ($(this).prev(curriculumImage)[0]) {
            $(this).prev(curriculumImage)[0].click();
        }
    });
})

$(document).on("change", ".curriculum__form--image--btn", function () {
    let element = this                             //操作された要素を取得
    let imagePreview = document.querySelector(".curriculum__form--image--preview");
    console.log(element);
    console.log(imagePreview);
    let fileReader = new FileReader();          //ファイルを読み取るオブジェクトを生成
    fileReader.readAsDataURL(element.files[0]);    //ファイルを読み取る
    fileReader.onload = (function () {
        $(imagePreview).attr('src', fileReader.result);
    });
})
