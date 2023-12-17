const content = {
    init: function () {
        this.addProcessComment()
        this.addAsyncComment()
        this.addInitTabs();
        this.addInitCollapse();
        this.addEmoji()
        this.addHighLight();
        this.addPageLike();
        this.addPostProtect();
        this.addCommentSecret();
        this.copyToClipBoard();
        this.addCatalog();
    },
    getFormData: function () {
        let text = document.querySelector('#textarea').value;
        let reply = document.querySelector('#comment-parent') ? document.querySelector('#comment-parent').value : false
        let author = document.querySelector('#author') ? document.querySelector('#author').value : false;
        let mail = document.querySelector('#mail')?.value;
        let url = document.querySelector('#url') ? document.querySelector('#url').value : false;
        let data = '';
        text = text.replace("&", "%26");
        // 判断是否登录,23.1.14
        if (!document.querySelector("#comment-form").dataset.login) {
            data = `author=${author}&mail=${mail}&`
        }
        if (url) {
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
    loadScript: (path) => {
        const is = document.getElementsByClassName('article-main');
        if (is.length > 0) {
            const js = document.createElement('script');
            js.setAttribute('src', `${themeUrl}assets/js/extend/${path}`);
            const first = document.getElementsByTagName('script')[0];
            first.parentNode.insertBefore(js, first);
        }
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
                    body: content.getFormData(),
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
                        }).showToast()
                        setTimeout(function () {
                            window.location.reload() ;
                        }, 100)
                    }
                })
            })
    },
    addEmoji: () => {
        let comments = document.getElementsByClassName('OwO')
        if (comments.length > 0) {
            // 说明在文章内容页
            content.loadScript('OwO.js')
        }
    },
    addHighLight: function () {
        content.loadScript('highlight.min.js')
    },
    addCatalog: () => {
        //生成文章目录
        let index = 0;
        let depth = 0;
        let tocTreeHtml = '';
        let tocTreeObj = document.getElementById('tocTree')
        let postContentObj = document.getElementsByTagName('main')[0]?.querySelector('.article-content');
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

        if (tocTreeHtml && tocTreeObj) {
            tocTreeObj.querySelector('.article-catalog-list').innerHTML = tocTreeHtml;
        }
    },
    addPageLike: () => {
        // 文章点赞
        document.querySelector('#agree-btn')?.addEventListener('click',
            function () {
                let allCookie = decodeURIComponent(getCookie("typechoAgreeRecording"));
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
    copyToClipBoard() {
        document.querySelector(".url-copy")?.addEventListener("click", function (e) {
            // 申请使用剪切板读取权限
            navigator.permissions.query({name: 'clipboard-read'}).then(function (result) {
                // 可能是 'granted', 'denied' or 'prompt':
                if (result.state === 'granted') {
                    // 可以使用权限
                    // 进行clipboard的操作
                    let clipBoardContent = "";
                    clipBoardContent += document.title;
                    clipBoardContent += "\r\n";
                    clipBoardContent += window.location.href;
                    navigator.clipboard
                        .writeText(clipBoardContent)
                        .then(
                            (clipText) => (Toastify({
                                text: "复制成功！快去分享哦~",
                                duration: 3000
                            }).showToast())
                        );
                } else {
                    // 弹窗弹框申请使用权限
                    Toastify({
                        text: "请先开通复制到剪贴板权限！",
                        duration: 3000,
                        backgroundColor: "#c02c38"
                    }).showToast()
                }
            });


        })
    }
}
content.init();