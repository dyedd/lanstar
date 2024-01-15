const app = {
    init: function () {
        this.addCopyright();
        this.addSelfAdaption();
        this.addScroll();
        this.addArticleLike();
        this.addMorePages();
        this.addObtainCategory();
        this.addDarkMode();
        this.navTextHighLight();
        this.addMobile();
    },
    setCookie: (name, value, seconds) => {
        seconds = seconds || 0;
        let expires = "";
        if (seconds != 0) { //设置cookie生存时间
            let date = new Date();
            date.setTime(date.getTime() + (seconds * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        document.cookie = name + "=" + escape(value) + expires + "; path=/"; //转码并赋值
    },
    secondToDate: (second) => {
        if (!second) {
            return 0;
        }
        const time = [0, 0, 0, 0, 0];
        if (second >= 365 * 24 * 3600) {
            time[0] = parseInt(second / (365 * 24 * 3600));
            second %= 365 * 24 * 3600;
        }
        if (second >= 24 * 3600) {
            time[1] = parseInt(second / (24 * 3600));
            second %= 24 * 3600;
        }
        if (second >= 3600) {
            time[2] = parseInt(second / 3600);
            second %= 3600;
        }
        if (second >= 60) {
            time[3] = parseInt(second / 60);
            second %= 60;
        }
        if (second > 0) {
            time[4] = second;
        }
        return time;
    },
    setTime: () => {
        const startTime = document.getElementById('our-company').getAttribute('data-start');
        let create_time = Math.round(new Date(startTime).getTime() / 1000);
        let timestamp = Math.round((new Date().getTime() + 8 * 60 * 60 * 1000) / 1000);
        let currentTime = app.secondToDate((timestamp - create_time));
        document.getElementById('our-company').innerHTML = '<span>' + currentTime[0] + '</span>' + '<svg class="icon" aria-hidden="true">\n' +
            '<use xlink:href="#icon-huaban"></use>' +
            '</svg><span>' + currentTime[1] + '</span><svg class="icon" aria-hidden="true">' +
            '<use xlink:href="#icon-tian"></use>' +
            '</svg><span>'
            + currentTime[2] + '</span><svg class="icon" aria-hidden="true">' +
            '<use xlink:href="#icon-shi"></use>' +
            '</svg><span>' + currentTime[3] + '</span><svg class="icon" aria-hidden="true">' +
            '<use xlink:href="#icon-fen"></use>' +
            '</svg><span>' + currentTime[4]
            + '</span><svg class="icon" aria-hidden="true">' +
            '<use xlink:href="#icon-miao"></use>' +
            '</svg>';
    },
    addMobile: ()=>{
        document.querySelector(".mobile-left")?.addEventListener('click',
            function () {
                document.querySelector(".left").classList.add("mobile-nav");
                document.querySelector(".fixed-body").style.display='block';
            }
        )
        document.querySelector(".mobile-right")?.addEventListener('click',
            function () {
                document.querySelector(".right").classList.add("mobile-nav");
            }
        )
        // 手机导航隐藏
        document.querySelector("#mobile-nav")?.addEventListener('click',
            function () {
                document.querySelector(".left").classList.remove("mobile-nav");
                document.querySelector(".right").classList.remove("mobile-nav");
                document.querySelector(".fixed-body").style.display='none';
            }
        )
        document.querySelector("#mobile-tool")?.addEventListener('click',
            function () {
                document.querySelector(".right").classList.remove("mobile-nav");
            }
        )
    },
    addDarkMode: () => {
        if (config['dark'] == '0') return false;
        // 根据时间
        let timeNow = new Date();
        // 获取当前小时
        let hours = timeNow.getHours();
        const method = {
            add: () => {
                document.documentElement.classList.add('theme-dark')
                document.querySelector('#carouselCaptions')?.classList.add('carousel-dark')
                document.querySelector('.chose-mode-day').style.display = 'none'
                document.querySelector('.chose-mode-moon').style.display = 'inline-block'
            },
            remove: () => {
                document.documentElement.classList.remove('theme-dark')
                document.querySelector('#carouselCaptions')?.classList.remove('carousel-dark')
                document.querySelector('.chose-mode-day').style.display = 'inline-block'
                document.querySelector('.chose-mode-moon').style.display = 'none'
            }
        }
        // 默认
        if (getCookie('night') == '1') {
            method.add()
        } else {
            method.remove()
        }
        if (!getCookie('night')) {
            // 自动
            if (hours > 6 && hours < 19) {
                method.remove()
            } else {
                method.add()
            }
        }
        document.querySelectorAll('#night-mode').forEach(item => {
            item.onclick = () => {
                if (getCookie('night') == '1') {
                    method.remove()
                    app.setCookie("night", "0", 1800)
                } else {
                    method.add()
                    app.setCookie("night", "1", 1800)
                }
            }
        })
        // 切换标签页时进行判断
        document.addEventListener('visibilitychange', function () {
            if (hours > 6 && hours < 19 || getCookie('night') == '0') {
                method.remove()
            } else {
                method.add()
            }
        });
    },
    addCopyright: () => {
        eval(function (p, a, c, k, e, r) {
            e = function (c) {
                return c.toString(a)
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function (e) {
                    return r[e]
                }];
                e = function () {
                    return '\\w+'
                };
                c = 1
            }
            ;
            while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('a.f(\' %c 9 1 %c b://d.e/8/1\',\'2:#3;4:#5;6:7 0\',\'2:#5;4:#3;6:7\');', 16, 16, '|lanstar|color|fadfa3|background|030307|padding|5px|dyedd|Theme|console|https||github|com|log'.split('|'), 0, {}));
    },
    addSelfAdaption: () => {
        // 获取dom
        let htmlDom = document.getElementsByTagName('html')[0];
        // 设置rem基准值的函数
        const setRem = () => {
            // 获取屏幕宽度
            let htmlWidth = document.documentElement.clientWidth || document.body.clientWidth;

            // 根据屏幕宽度设置rem基准值
            if (htmlWidth >= 800) {
                htmlDom.style.fontSize = '10px';
            } else if(htmlWidth < 800) {
                htmlDom.style.fontSize = '12px';
            }
        };
        // 初始化时设置rem基准值
        setRem();
        // 监听屏幕变化，从而改变1rem的值
        window.addEventListener('resize', setRem);
    },
    addScroll: function () {
        window.addEventListener('scroll', function () {
            let scrollTop = document.documentElement.scrollTop;
            if (scrollTop > 1700) {
                document.querySelector('.footer').classList.add('is-fixed')
            } else {
                document.querySelector('.footer').classList.remove('is-fixed')
            }
        }, true)
    },
    addBackTop: function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    },
    addArticleLike: () => {
        // 首页点赞
        document.querySelector('.articles')?.addEventListener('click', function (e) {
            if (e.target.matches("use")) {
                let allCookie = decodeURIComponent(getCookie("typechoAgreeRecording"));
                let filterCookie = allCookie.slice(1, -1).replaceAll('"', "").split(',')
                if (filterCookie.includes(e.target.parentNode.parentNode.dataset.cid)) {
                    Toastify({
                        text: '已经点赞过了！',
                        duration: 3000,
                        backgroundColor: "linear-gradient(to right, #fa709a 0%, #fee140 100%)"
                    }).showToast();
                } else {
                    fetch(location.href, {
                        method: "post",
                        body: `agree=${e.target.parentNode.parentNode.dataset.cid}`,
                        headers: {
                            "content-type": "application/x-www-form-urlencoded"
                        }
                    }).then(res => {
                        return res.text()
                    }).then((data) => {
                        //  匹配数字
                        if (/\d/.test(data)) {
                            //  把点赞按钮中的点赞数量设置为传回的点赞数量
                            e.target.parentNode.parentNode.childNodes[3].textContent = data
                            Toastify({
                                text: "点赞成功！",
                                duration: 3000
                            }).showToast();
                        }
                    })
                }
            }
        })
    },
    addCoupleTime: () => {
        setInterval(app.setTime, 1000);
    },
    addMorePages() {
        document.querySelector('.page-pagination .next')?.addEventListener(
            'click',
            function (e) {
                e.preventDefault()
                this.classList.add('loading');
                this.textContent = '努力加载'
                let href = this.getAttribute("href")
                if (href != undefined) {
                    fetch(href, {
                        method: "get",
                    }).then(res => {
                        return res.text()
                    }).then(data => {
                        this.classList.remove('loading');
                        this.textContent = '查看更多'
                        const el = document.createElement('div')
                        el.innerHTML = data
                        const res = el.querySelectorAll('.article-list')
                        res.forEach(v => document.querySelector(".articles").append(v))
                        window.ViewImage && ViewImage.init('.gallery img');
                        lazyload(document.querySelectorAll(".lazy"));
                        if(href.includes("category")) {
                            const activeLi = el.querySelector('.pagination li.active');
                            const nextSibling = activeLi.nextElementSibling;
                            if(!nextSibling){
                                document.querySelector('.page-pagination').style.display = 'none'
                            }else{
                                document.querySelector('.page-pagination').style.display = 'flex'
                                document.querySelector('.next').setAttribute('href', nextSibling.querySelector('a').getAttribute('href'));
                            }
                        }else{
                            let next_href = el.querySelector('.next')?.getAttribute('href')
                            if (next_href != null) {
                                this.setAttribute('href', next_href);
                                this.style.display = 'flex'
                            } else {
                                //如果没有下一页了，隐藏
                                this.style.display = 'none'
                            }
                        }
                    })
                }
            }
        )
    },
    addObtainCategory() {
        document.querySelectorAll('.category div').forEach(item => {
            item.onclick = () => {
                document.querySelector('.rainbow-loader').style.display = 'block';
                let href = item.dataset.href || location.href;
                if (href != '#') {
                    fetch(href, {
                        method: 'get'
                    }).then(res => {
                        return res.text()
                    }).then(data => {
                        document.querySelector('.rainbow-loader').style.display = 'none';
                        // 清空子元素
                        let ele;
                        while ((ele = document.querySelector('.articles').firstChild)) {
                            ele.remove();
                        }
                        for (let i = 0; i < document.querySelectorAll('.category div').length; ++i) {
                            if (document.querySelectorAll('.category div')[i] != item) {
                                document.querySelectorAll('.category div')[i].classList.remove('active')
                            }
                        }
                        item.classList.add("active")
                        const el = document.createElement('div')
                        el.innerHTML = data
                        const res = el.querySelectorAll('.article-list')
                        res.forEach(v => document.querySelector(".articles").append(v))
                        const activeLi = el.querySelector('.pagination li.active');
                        const nextSibling = activeLi?.nextElementSibling;
                        const isLastChild = activeLi?.matches(':last-child');
                        if(activeLi==null || isLastChild){
                            document.querySelector('.page-pagination').style.display = 'none'
                        }else{
                            document.querySelector('.page-pagination').style.display = 'flex'
                            document.querySelector('.next').setAttribute('href', nextSibling?.querySelector('a').getAttribute('href'));
                        }
                        window.ViewImage && ViewImage.init('.gallery img');
                        lazyload(document.querySelectorAll(".lazy"));
                    })
                }
            }
        })
    },
    navTextHighLight() {
        // 获取所有的 nav-link 元素
        const navLinks = document.querySelectorAll('.nav-link');

        // 为每个 nav-item 添加点击事件处理程序
        navLinks.forEach(item => {
            item.addEventListener('click', () => {
                // 移除其他 nav-item 的 active 类
                navLinks.forEach(navLink => {
                    navLink.classList.remove('active');
                });

                // 给当前点击的 nav-item 添加 active 类
                item.classList.add('active');
            });
        });
    }
}
app.init();