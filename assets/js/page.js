let pageInit=function () {
    let owo = $(".OwO");
    if(owo.length > 0){
        new OwO({
            logo: 'OωO',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('owo-textarea')[0],
            api: owoJson,
            position: 'down',
            width: '280px',
            maxHeight: '250px'
        });
    }
}
pageInit();
function highlight()
{
    //增加行号
    let pres = document.querySelectorAll('pre');
    let lineNumberClassName = 'line-numbers';
    pres.forEach(function (item, index) {
        item.className = item.className === '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
    });
}
highlight();
function catalogInit() {
    let catalog_btn = document.getElementById('article-list-btn');
    if (catalog_btn) {
        catalog_btn.addEventListener('click',function () {
            //生成文章目录
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
        })
        // 关闭
        document.getElementById('catalog-close').addEventListener('click',
            function() {
                document.getElementById('tocTree').classList.remove('on');
            });
    }
}
catalogInit();
$('.protected-btn').click(function() {
    let surl=$(".protected").attr("action");
    $.ajax({
        type: "POST",
        url:surl,
        data:$('.protected').serialize(),
        error: function(request) {
            alert("密码提交失败，请刷新页面重试！");
        },
        success: function(data) {

            if(data.indexOf("密码错误") >= 0 && data.indexOf("<title>Error</title>") >= 0) {
                alert("密码错误，请重试！");
            }else{
                location.reload();
            }
        }
    });
});
let holder = $('.comment-respond textarea').attr('placeholder');
// 私密
$('#secret-button').click(function () {
    let textareaDom = $('.comment-respond textarea');
    if($(this).is(':checked')) {
        textareaDom.attr('placeholder', '私密回复中')
    }else {
        textareaDom.attr('placeholder', holder)
    }
})
function ac() {
    let $body = $('html,body');
    let g = '.comment-list'
        , h = '.comment-num'
        , i = '.comment-reply a'
        , j = '#textarea'
        , k = ''
        , l = '';
    c();
    $('#comment-form').submit(function() {
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $(this).serializeArray(),
            error: function() {
                alert("提交失败，请检查网络并重试或者联系管理员。");
                return false
            },
            success: function(d) {
                if (!$(g, d).length) {
                    alert("您输入的内容不符合规则或者回复太频繁，请修改内容或者稍等片刻。");
                    return false
                } else {
                    k = $(g, d).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function(a, b) {
                        return a - b
                    }).pop();
                    if ($('.page-navigator .prev').length && l == "") {
                        k = ''
                    }
                    if (l) {
                        d = $('#comment-' + k, d).hide();
                        if ($('#' + l).find(".comment-children").length <= 0) {
                            $('#' + l).append("<div class='comment-children'><ol class='comment-list'><\/ol><\/div>")
                        }
                        if (k)
                            $('#' + l + " .comment-children .comment-list").prepend(d);
                        l = ''
                    } else {
                        d = $('#comment-' + k, d).hide();
                        if (!$(g).length)
                            $('.comment-detail').prepend("<h2 class='comment-num'>0 条评论<\/h2><ol class='comment-list'><\/ol>");
                        $(g).prepend(d)
                    }
                    $('#comment-' + k).fadeIn();
                    let f;
                    $(h).length ? (f = parseInt($(h).text().match(/\d+/)),
                        $(h).html($(h).html().replace(f, f + 1))) : 0;
                    TypechoComment.cancelReply();
                    $(j).val('');
                    $(i + ', #cancel-comment-reply-link').unbind('click');
                    c();
                    if (k) {
                        $body.animate({
                            scrollTop: $('#comment-' + k).offset().top - 50
                        }, 300)
                    } else {
                        $body.animate({
                            scrollTop: $('#comments').offset().top - 50
                        }, 300)
                    }
                }
            }
        });
        return false
    });
    function c() {
        $(i).click(function() {
            l = $(this).parent().parent().parent().attr("id")
        });
        $('#cancel-comment-reply-link').click(function() {
            l = ''
        })
    }
}
ac();
// 文章点赞
function pageLike(){
    $('#agree-btn').on('click', function () {
        $(this).get(0).disabled = true;  //  禁用点赞按钮
        //  发送 AJAX 请求
        $.ajax({
            //  请求方式 post
            type: 'post',
            //  url 获取点赞按钮的自定义 url 属性
            //  发送的数据 cid，直接获取点赞按钮的 cid 属性
            data: 'agree=' + $(this).attr('data-cid'),
            async: true,
            timeout: 30000,
            cache: false,
            //  请求成功的函数
            success: function (data) {
                let re = /\d/;  //  匹配数字的正则表达式
                //  匹配数字
                if (re.test(data)) {
                    //  把点赞按钮中的点赞数量设置为传回的点赞数量
                    $('#agree-btn .agree-num').html(data);
                }
            },
            error: function () {
                //  如果请求出错就恢复点赞按钮
                $(this).get(0).disabled = false;
            },
        });
    });
}
pageLike();
