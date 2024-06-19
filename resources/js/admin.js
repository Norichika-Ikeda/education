import './bootstrap';

$(function () {
    $(document).on('click', '.curriculum__class__btn button', function () {
        let grade = $(this).data('num');
        $('.curriculum__top__btn--grade').empty();
        $('.curriculum__class__btn').empty();
        $('.curriculum__card').empty();
        $.ajax({
            type: 'GET',
            url: grade,
            async: false,
            data: {
                grade: grade
            },
            dataType: 'json',
        }).done(function (data) {
            //現在表示中の学年を表示
            let now_class_id = data.now_class.id;
            let now_class_name = data.now_class.name;
            let insert_now_class = `<p class="py-1" data-num=${now_class_id}>${now_class_name}</p>`;
            $('.curriculum__top__btn--grade').append(insert_now_class);

            //現在表示中の学年以外のボタンを表示
            let classes_response = data.classes;
            $.each(classes_response, function (index, value) {
                let classes_id = value.id;
                let classes_name = value.name;
                let insert_classes = `<button type="submit" class="classes-btn my-2 py-1" data-num=${classes_id}>${classes_name}</button>`;
                $('.curriculum__class__btn').append(insert_classes);
            })

            //現在表示中の学年のカリキュラムを表示
            let curriculums_response = data.curriculums;
            let delivery_times_response = data.delivery_times;
            $.each(curriculums_response, function (index, value) {
                let curriculum_id = value.id;
                let thumbnail = value.thumbnail;
                let title = value.title;
                let flag = value.alway_delivery_flg;
                let insert_curriculums = `<div class="curriculum__card__item card p-4 m-2">`;
                if (thumbnail !== null) {
                    insert_curriculums += `<div class="curriculum__card__item--thumbnail">
                    <img src="http://localhost/education/public/storage/${thumbnail}" alt="">
                </div>
                <p>${title}</p>
                <div class="delivery-time-area">`;
                }else {
                    insert_curriculums += `<div class="curriculum__card__item--thumbnail">
                </div>
                <p>${title}</p>
                <div class="delivery-time-area">`;
                };
                if (flag == 1) {
                    insert_curriculums += '<p>常時公開</p>';
                } else {
                    $.each(delivery_times_response, function (index, value) {
                        let delivery_times_id = value.curriculums_id;
                        if (curriculum_id == delivery_times_id) {
                            let delivery_from = new Date(value.delivery_from);
                            let month_from = delivery_from.getMonth() + 1;
                            let date_from = delivery_from.getDate();
                            let hour_from = delivery_from.getHours().toString().padStart(2, '0');
                            let minutes_from = delivery_from.getMinutes().toString().padStart(2, '0');
                            let delivery_to = new Date(value.delivery_to);
                            let hour_to = delivery_to.getHours().toString().padStart(2, '0');
                            let minutes_to = delivery_to.getMinutes().toString().padStart(2, '0');
                            insert_curriculums += `<ul class="delivery-time-list d-flex justify-content-between mb-1">
                            <li>${month_from}月${date_from}日</li>
                            <li>${hour_from}:${minutes_from} ～ ${hour_to}:${minutes_to}</li>
                        </ul>`;
                        }
                    })
                };
                insert_curriculums += `</div><div class="curriculum__card__item--edit d-flex justify-content-between">
                    <form method="GET" action="http://localhost/education/public/admin/curriculum_edit/${curriculum_id}" accept-charset="UTF-8">
                    <button type="submit" class="curriculum-edit">授業内容編集</button>
                    </form>
                    <form method="GET" action="http://localhost/education/public/admin/delivery_time_setting/${curriculum_id}" accept-charset="UTF-8">
                    <button type="submit" class="delivery-time-edit">配信日時編集</button>
                    </form>
                </div>
            </div>`;
                $('.curriculum__card').append(insert_curriculums);
            })
        }).fail(function () {
            //ajax通信がエラーのときの処理
            console.log('通信に失敗しました。');
        })
    })
})

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
        let addDeliveryTimeForm =
            `<div class="delivery-time__form--date d-flex align-items-center">
            <input type = "hidden" name = "delivery_time_id[]" value = "" >
            <input type="date" name="date_from[]" class="date-from" value="" placeholder="年月日" required>
            <input type="time" name="time_from[]" class="time-from" value="" placeholder="日時" required>
            <p>～</p>
            <input type="date" name="date_to[]" class="date-to" value="" placeholder="年月日" required>
            <input type="time" name="time_to[]" class="time-to" value="" placeholder="日時" required>
            <div class="delivery-time__form--remove"></div>
            </div>`;
        $(addDeliveryTimeForm).insertBefore('#addDeliveryTime').hide().fadeIn(300);
    })
})

$('.delivery-time__form--date input[type="date"]').map(function () {
    $(document).on('blur', '.delivery-time__form--date input[type="date"]', (function () {
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

$('.delivery-time__form--date input[type="time"]').map(function () {
    $(document).on('blur', '.delivery-time__form--date input[type="time"]', (function () {
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

$('.article__form--date input[type="date"]').map(function () {
    $(document).on('blur', '.article__form--date input[type="date"]', (function () {
        if ($(this).val()) {
            $(this).addClass('is-blank');
        } else {
            $(this).removeClass('is-blank');
        }
    })
    )
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
            $(elem).before('<img src="" alt="" width="240px" class="banner-image">');
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
                clickElement.parents('.banner__form--select').remove();
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
                `<div class="banner__form--select align-items-center w-50">
                <input type = "hidden" name = "banner_id[]" class="banner-id" value="">
                <input type="file" name="banner[]" class="banner-form " value="" style="display:none">
                <button type="button" name="{{ $banner->id }}" class="banner-select ms-5">ファイルを選択</button>
                <div class="remove-banner ms-5"></div>
                </div>`;
                $(addBannerForm).insertBefore('#addBanner').hide().fadeIn(300);
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
