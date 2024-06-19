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

$(function () {
    let now_date = new Date();
    let year = now_date.getFullYear();
    let month = now_date.getMonth() + 1;
    let view_date = $('.timetable__top--change h3');

    $(document).on('click', '#prevMonthTimetable', function () {
        month--;
        if (month == 0) {
            month = 12;
            year--;
        }
        $(view_date).attr('data-date', month);
        $(view_date).html(year + '年' + month + '月スケジュール');
        let curriculum_list = $('.curriculum__card');
        curriculum_list.empty();
        $.ajax({
            url: 'prev_timetable?date=' + year + month,
            type: 'GET',
            data: {
                year: year,
                month: month.toString().padStart(2, '0'),
            },
            dataType: 'Json',
        }).done(function (data) {
            $.each(data.curriculums, function (index, value) {
                let insert_curriculums = `
                <div class="curriculum__card__item card p-4 m-2">
                    <div class="curriculum__card__item--thumbnail">`;
                if (value.thumbnail !== null) {
                    insert_curriculums += `<img src="http://localhost/education/public/storage/${value.thumbnail}" alt=""></img>`;
                };
                insert_curriculums += `</div>
                    <a href="#">${value.title}</a>
                    <div class="delivery-time-area"></div>
                </div>`
                $(curriculum_list).append(insert_curriculums);
            })
        }).fail(function () {
            //ajax通信がエラーのときの処理
            console.log('通信に失敗しました。');
        });
    })
})
