const utils = {
    getFormData: function () {
        let text = document.querySelector('#textarea').value;
        let reply = document.querySelector('#comment-parent') ? document.querySelector('#comment-parent').value : false
        let author = document.querySelector('#author') ? document.querySelector('#author').value : false;
        let mail = document.querySelector('#mail')?.value;
        let url = document.querySelector('#url') ? document.querySelector('#url').value : false;
        let data = '';
        text = text.replace("&", "%26");
        // 判断是否登录,23.1.14
        if(!document.querySelector("#comment-form").dataset.login){
            data = `author=${author}&mail=${mail}&`
        }
        if(url){
            data += `url=${url}&`
        }
        // 防止参数带&截断，2023.1.2
        if (reply) {
            data += `text=${text}&parent=${reply}`
        } else {
            data += `text=${text}`
        }
        return data
    },
    getCookie: (name) => document.cookie.match(`[;\s+]?${name}=([^;]*)`)?.pop(),
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
        let currentTime = utils.secondToDate((timestamp - create_time));
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
    loadScript: (path) => {
        const is = document.getElementsByClassName('article-main');
        if (is.length > 0) {
            const js = document.createElement('script');
            js.setAttribute('src', `${themeUrl}assets/js/extend/${path}`);
            const first = document.getElementsByTagName('script')[0];
            first.parentNode.insertBefore(js, first);
        }
    }
}
const lanstar = {
    init: function () {
        this.addCopyright()
        this.addSelfAdaption()
        this.addProcessComment()
        this.addAsyncComment()
        this.addScroll()
        this.addArticleLike();
        this.addInitTabs();
        this.addInitCollapse();
        this.addMorePages();
        this.addObtainCategory();
        this.addEmoji()
        this.addHighLight();
        this.addPageLike();
        this.addArchiveToggle()
        this.addPostProtect();
        this.addCommentSecret();
        this.addTa()
        this.addDarkMode();
        this.copyToClipBoard();
        this.navTextHighLight();
    },
    addTa: () => {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        window.ViewImage && ViewImage.init('.gallery img');
        let images = document.querySelectorAll(".lazy");
        lazyload(images);
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
        if (utils.getCookie('night') == '1') {
            method.add()
        } else {
            method.remove()
        }
        if (!utils.getCookie('night')) {
            // 自动
            if (hours > 6 && hours < 19) {
                method.remove()
            } else {
                method.add()
            }
        }
        document.querySelectorAll('#night-mode').forEach(item => {
            item.onclick = () => {
                if (utils.getCookie('night') == '1') {
                    method.remove()
                    utils.setCookie("night","0",1800)
                } else {
                    method.add()
                    utils.setCookie("night","1",1800)
                }
            }
        })
        // 切换标签页时进行判断
        document.addEventListener('visibilitychange', function () {
            if (hours > 6 && hours < 19 || utils.getCookie('night') == '0') {
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
        //获取屏幕宽度
        let htmlWidth = document.documentElement.clientWidth || document.body.clientWidth;
        //获取dom
        let htmlDom = document.getElementsByTagName('html')[0];
        //设置rem基准值
        htmlDom.style.fontSize = 10 + 'px';
        //监听屏幕变化 从而改变1rem的值
        document.documentElement.addEventListener('resize', (e) => {
            let htmlWidth = document.documentElement.clientWidth || document.body.clientWidth;
            htmlDom.style.fontSize = htmlWidth * 100 / 750 + 'px';
        })
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
    addProcessComment: () => {
        window.TypechoComment = {
            dom: function (id) {
                return document.getElementById(id);
            },
            create: function (tag, attr) {
                let el = document.createElement(tag);
                for (let key in attr) {
                    el.setAttribute(key, attr[key]);
                }
                return el;
            },

            reply: function (cid, coid) {
                let comment = this.dom(cid),
                    response = this.dom(document.querySelector("#comments").dataset.respondid),
                    input = this.dom('comment-parent'),
                    form = 'form' === response.tagName ? response : response.getElementsByTagName('form')[0],
                    textarea = response.getElementsByTagName('textarea')[0];

                if (null == input) {
                    input = this.create('input', {
                        'type': 'hidden',
                        'name': 'parent',
                        'id': 'comment-parent'
                    });
                    form.appendChild(input);
                }

                input.setAttribute('value', coid);

                if (null == this.dom('comment-form-place-holder')) {
                    let holder = this.create('div', {
                        'id': 'comment-form-place-holder'
                    });
                    response.parentNode.insertBefore(holder, response);
                }

                let children = comment.getElementsByClassName(
                    'comment-children'
                );

                if (children.length) {
                    comment.insertBefore(response, children[0]);
                } else {
                    comment.appendChild(response);
                }

                this.dom('cancel-comment-reply-link').style.display = '';
                if (null != textarea && 'text' === textarea.name) {
                    textarea.focus();
                }
                return false;
            },

            cancelReply: function () {
                let response = this.dom(document.querySelector("#comments").dataset.respondid),
                    holder = this.dom('comment-form-place-holder'),
                    input = this.dom('comment-parent');

                if (null != input) {
                    input.parentNode.removeChild(input);
                }
                if (null == holder) {
                    return true;
                }

                this.dom('cancel-comment-reply-link').style.display = 'none';
                holder.parentNode.insertBefore(response, holder);
                return false;
            }
        }
    },
    addAsyncComment: function () {
        document.querySelector('#comment-form')?.addEventListener('submit',
            function (e) {
                e.preventDefault();
                if (this.dataset.disabled == 'disabled') return;
                this.dataset.disabled = 'disabled';
                document.querySelector('.comments-toolbar .submit').textContent = '传输中...';
                console.log(this.getAttribute('action'))
                fetch(this.getAttribute('action'), {
                    method: 'post',
                    body: utils.getFormData(),
                    headers: {
                        "content-type": "application/x-www-form-urlencoded"
                    }
                }).then(res => {
                    if (res.status == '200') {
                        let url = location.href;
                        Toastify({
                            text: '发送成功!',
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            className: "success",
                        }).showToast().then(
                            setTimeout(function () {
                                window.location.href = url;
                            }, 100)
                        );
                    }
                })
            })
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
                let allCookie = decodeURIComponent(utils.getCookie("typechoAgreeRecording"));
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
    addEmoji: () => {
        let comments = document.getElementsByClassName('OwO')
        if (comments.length > 0) {
            // 说明在文章内容页
            utils.loadScript('OwO.js')
        }
    },
    addHighLight: function () {
        utils.loadScript('highlight.min.js')
    },
    addCatalog: () => {
        //生成文章目录
        let index = 0;
        let depth = 0;
        let tocTreeHtml = '';
        let tocTreeObj = document.getElementById('tocTree')
        let postContentObj = document.getElementsByTagName('main')[0].querySelector('.article-content');
        postContentObj.innerHTML = postContentObj.innerHTML.replace(/<h([1-6])(.*?)>(.*?)<\/h\1>/ig, function (match, num, attrs, html) {
            index++;
            if (depth < num) {
                if (index > 1) {
                    tocTreeHtml += '</li><li><ul class="article-catalog-list"><li><a href="#index-' + index + '">' + html + '</a>';
                } else {
                    tocTreeHtml += '<li><a href="#index-' + index + '">' + html + '</a>';
                }
            } else if (depth === num) {
                tocTreeHtml += '</li><li><a href="#index-' + index + '">' + html + '</a>';
            } else if (depth > num) {
                tocTreeHtml += '</li>' + (new Array(depth - num + 1).join('</ul></li>')) + '<li><a href="#index-' + index + '">' + html + '</a>';
            }
            depth = num;
            return '<h' + num + attrs + ' id="index-' + (index) + '">' + html + '</h' + num + '>';
        })

        if (tocTreeHtml) {
            tocTreeObj.classList.add('on');
            tocTreeObj.querySelector('.article-catalog-list').innerHTML = tocTreeHtml;
        }
        // 关闭
        document.getElementById('catalog-close').addEventListener('click',
            function () {
                document.getElementById('tocTree').classList.remove('on');
            });
    },
    addPageLike: () => {
        // 文章点赞
        document.querySelector('#agree-btn')?.addEventListener('click',
            function () {
                let allCookie = decodeURIComponent(utils.getCookie("typechoAgreeRecording"));
                let filterCookie = allCookie.slice(1, -1).replaceAll('"', "").split(',')
                if (filterCookie.includes(this.dataset.cid)) {
                    Toastify({
                        text: '你已经点赞过了，不给取消！',
                        duration: 3000,
                        backgroundColor: "linear-gradient(to right, #fa709a 0%, #fee140 100%)"
                    }).showToast();
                } else {
                    console.log(this.dataset.cid)
                    fetch(location.href, {
                        method: "post",
                        body: 'agree=' + this.dataset.cid,
                        headers: {
                            "content-type": "application/x-www-form-urlencoded"
                        }
                    }).then(res => {
                        return res.text()
                    }).then(data => {
                        //  匹配数字
                        if (/\d/.test(data)) {
                            //  把点赞按钮中的点赞数量设置为传回的点赞数量
                            document.querySelector('#agree-btn .agree-num').textContent = data;
                            Toastify({
                                text: "点赞成功！",
                                duration: 3000
                            }).showToast();
                        }
                    })
                }
            })
    },
    addArchiveToggle: () => {
        const panel = document.querySelectorAll('.article-archives .panel')
        if (panel.length > 0) {
            // 默认第一个展开
            panel[0].nextElementSibling.style.display = 'block';
            panel.forEach(item => {
                item.onclick = () => {
                    // 排它思想
                    for (let i = 0; i < panel.length; ++i) {
                        if (panel[i] != item) {
                            panel[i].nextElementSibling.style.display = 'none';
                        }
                    }
                    item.nextElementSibling.style.display = 'block'
                }
            })
        }
    },
    addCoupleTime: () => {
        setInterval(utils.setTime, 1000);
    },
    addPostProtect: () => {
        document.querySelector('.protected-btn')?.addEventListener('click', function () {
            let url = document.querySelector('.protected').getAttribute('action')
            fetch(url, {
                method: "post",
                body: `protectPassword=${document.querySelector("input[name='protectPassword']").value}&protectCID=${document.querySelector("input[name='protectCID']").value}`,
                headers: {
                    "content-type": "application/x-www-form-urlencoded"
                },
            }).then(res => {
                return res.text()
            }).then(data => {
                if (data.indexOf("密码错误") >= 0 || data.indexOf("<title>Error</title>") >= 0) {
                    Toastify({
                        text: '密码错误，请重试！',
                        duration: 3000,
                        backgroundColor: "#c02c38"
                    }).showToast();
                } else {
                    location.reload();
                }
            })
        })
    },
    addCommentSecret: () => {
        let holder = document.querySelector('#comment-form textarea')?.getAttribute('placeholder')
        document.querySelector('#secret-button')?.addEventListener('click', function () {
            let textareaDom = document.querySelector('#comment-form textarea')
            if (this.checked) {
                textareaDom.setAttribute('placeholder', '私密回复中')
            } else {
                textareaDom.setAttribute('placeholder', holder)
            }
        })
    },
    addInitTabs: () => {
        let tabs = document.querySelectorAll('.article-tabs .nav');
        if (tabs.length > 0) {
            for (let item in tabs) {
                tabs[item].onclick = function (e) {
                    let panel = e.target.dataset.panel;
                    let spanArr = tabs[item].querySelectorAll("span");
                    let index = 0;
                    for (let i = 0; i < spanArr.length; ++i) {
                        if (i != panel) {
                            spanArr[i].classList.remove('active');
                            e.target.parentNode.nextElementSibling.children[i].style.display = 'none'
                        } else {
                            index = i;
                        }
                    }
                    e.target.classList.add('active');
                    e.target.parentNode.nextElementSibling.children[index].style.display = 'block'
                }
            }
        }
    },
    addInitCollapse: () => {
        let collapses = document.querySelectorAll('.article-collapse .collapse-head');
        if (collapses.length > 0) {
            for (let item in collapses) {
                collapses[item].onclick = function (e) {
                    if (e.target.nextElementSibling.style.display == 'block') {
                        e.target.nextElementSibling.style.display = 'none'
                    } else if (e.target.nextElementSibling.style.display == '' || e.target.nextElementSibling.style.display == 'none') {
                        e.target.nextElementSibling.style.display = 'block'
                    }
                }
            }
        }
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
                        let next_href = el.querySelector('.next')?.getAttribute('href')
                        if (next_href != null) {
                            this.setAttribute('href', next_href);
                        } else {
                            //如果没有下一页了，隐藏
                            this.style.display = 'none'
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
                        let more = el.querySelector('.next')?.getAttribute('href')
                        if (more != null) {
                            document.querySelector('.next').setAttribute('href', more);
                        } else {
                            document.querySelector('.next').style.display = 'none'
                        }
                    })
                }
            }
        })
    },
    copyToClipBoard(){
        document.querySelector(".url-copy")?.addEventListener("click",function(e){
            // 申请使用剪切板读取权限
            navigator.permissions.query({ name: 'clipboard-read' }).then(function(result) {
                // 可能是 'granted', 'denied' or 'prompt':
                if (result.state === 'granted') {
                    // 可以使用权限
                    // 进行clipboard的操作
                    let clipBoardContent="";
                    clipBoardContent+=document.title;
                    clipBoardContent+="\r\n";
                    clipBoardContent+=window.location.href;
                    navigator.clipboard
                        .writeText(clipBoardContent)
                        .then(
                            (clipText) => (Toastify({
                                text: "复制成功！快去分享哦~",
                                duration: 3000
                            }).showToast())
                        );
                } else{
                    // 弹窗弹框申请使用权限
                    Toastify({
                        text: "请先开通复制到剪贴板权限！",
                        duration: 3000,
                        backgroundColor: "#c02c38"
                    }).showToast()
                }
            });


        })
    },
    navTextHighLight(){
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