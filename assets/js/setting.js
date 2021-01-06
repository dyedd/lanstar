'use strict';
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        let TabItems = document.querySelectorAll('.theme-setting-tab li');
        let Notice = document.querySelector('.theme-setting-notice');
        let Version = document.querySelector('#theme-version');
        let Form = document.querySelector('.theme-setting-contain > form');
        let Content = document.querySelectorAll('.theme-setting-content');
        TabItems.forEach(function (item) {
            item.addEventListener('click', function () {
                sessionStorage.setItem('theme-setting-current', item.getAttribute('data-current'));
                TabItems.forEach(function (_item) {
                    return _item.classList.remove('active');
                });
                item.classList.add('active');

                if (item.getAttribute('data-current') === 'theme-setting-notice') {
                    Notice.style.display = 'block';
                    Form.style.display = 'none';
                } else {
                    Form.style.display = 'block';
                    Notice.style.display = 'none';
                }

                Content.forEach(function (_item) {
                    _item.style.display = 'none';
                    if (_item.classList.contains(item.getAttribute('data-current'))) _item.style.display = 'block';
                });
            });
        });
        /* 页面第一次进来 */
        if (sessionStorage.getItem('theme-setting-current')) {
            if (sessionStorage.getItem('theme-setting-current') === 'theme-setting-notice') {
                Notice.style.display = 'block';
                Form.style.display = 'none';
            } else {
                Form.style.display = 'block';
                Notice.style.display = 'none';
            }

            TabItems.forEach(function (item) {
                if (item.getAttribute('data-current') === sessionStorage.getItem('theme-setting-current')) {
                    item.classList.add('active');
                    Content.forEach(function (_item) {
                        if (_item.classList.contains(sessionStorage.getItem('theme-setting-current'))) _item.style.display = 'block';
                    });
                }
            });
        } else {
            TabItems[0].classList.add('active');
            Notice.style.display = 'block';
            Form.style.display = 'none';
        }
        const xhr = new XMLHttpRequest();
        const authorInfo = '<h1 class="theme-plane">Lanstar 主题设置面板</h1>' +
            '<p>作者博客：<a href="https://dyedd.cn">染念</a></p>' +
            '<p>欢迎大家对本项目进行star以及可以的赞助~</p>' +
            '<p><a href="http://lanstar.dyedd.cn"><b>主题文档</b></a></p>' +
            '<p><a href="http://lanstar.dyedd.cn/#/history">更新记录</a></p>'
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304) {
                    let res = JSON.parse(xhr.responseText);
                    let str = '';
                    if (res.tag_name !== Version.innerHTML) {
                        str = `<a class="update" target="_blank" href="https://github.com/dyedd/lanstar/releases/tag/${res.tag_name}">检测到版本更新！</a>`
                    } else {
                        str = '<span class="no-update">当前已是最新版本！</span>'
                    }
                    str = authorInfo +
                        '<p>当前版本号：' + Version.innerHTML + str + '</p>' +
                        '<p>最新版本号：' + res.tag_name + '</p>' + '<br><p>👉查看新版亮点</p>' +
                        `<p>${res.body}</p><br>`.replace(/\n/g, '<br/>');
                    Notice.innerHTML = str;
                    Notice.innerHTML += '<form class="theme-backup" action="?bf" method="post">' +
                        '<input type="submit" name="type" value="备份模板" />' +
                        '<input type="submit" name="type" value="还原备份" />' +
                        '<input type="submit" name="type" value="删除备份" />' +
                        '</form>';
                } else {
                    Notice.innerHTML = '请求失败！';
                }
            }
        };
        xhr.open('get', 'https://api.github.com/repos/dyedd/lanstar/releases/latest', true);
        xhr.send(null);
    });
})();
