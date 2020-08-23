//增加行号
(function(){
    let pres = document.querySelectorAll('pre');
    let lineNumberClassName = 'line-numbers';
    pres.forEach(function (item, index) {
        item.className = item.className === '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
    });
})();

document.getElementById('article-list-btn').addEventListener('click',function () {
    //生成文章目录
    (function () {
        let index = 0;
        let depth = 0;
        let tocTreeHtml = '';
        let tocTreeObj = document.getElementById('tocTree')
        let postContentObj = document.getElementsByTagName('article')[0].querySelector('.article-content');
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
    })();
})
// 关闭
document.getElementById('catalog-close').addEventListener('click',
    function() {
        document.getElementById('tocTree').classList.remove('on');
    });
