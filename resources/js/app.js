import './bootstrap';


(function (d) {
    let banner = d.getElementById("bannerArea");

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
})(document);
