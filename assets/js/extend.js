console.log(' %c Theme lanstar %c https://github.com/dyedd/lanstar', 'color:#444;background:#eee;padding:5px 0', 'color:#eee;background:#444;padding:5px');

//初始化tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
//
$('.close').on('click',function () {
    $('.search-block').collapse('hide')
})
$('#search-block').on('show.bs.collapse', function () {
    $('.nav-menu').css({'position':'relative','z-index':'-1'})
    $('#carouselExampleIndicators').css({'position':'relative','z-index':'-1'})
    $('.user-container').css({'position':'relative','z-index':'-1'})
})
$('#search-block').on('hidden.bs.collapse', function () {
    $('.nav-menu').removeAttr('style')
    $('#carouselExampleIndicators').removeAttr('style')
    $('.user-container').removeAttr('style')
})
$(function (){
    // 根据时间
    let timeNow = new Date();
// 获取当前小时
    let hours = timeNow.getHours();
    if (hours > 6 && hours < 19) {
        $('body').removeClass('theme-dark')
    } else {
        $('body').addClass('theme-dark')
    }
})
// 首页点赞
$('.content-action').each(function (i, n){
    $(n).find('.btn-like').on('click', function (){
        $(this).get(0).disabled = true;  //  禁用点赞按钮
        $.ajax({
            type: 'post',
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
                    $($('.btn-like').find('span.agree-num')[i]).html(data);
                }
            },
            error: function () {
                //  如果请求出错就恢复点赞按钮
                $(this).get(0).disabled = false;
            },
        });
    })
})
// 文章点赞
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
$(function () {
    $(window).scroll(function () {
        var scroHei = $(window).scrollTop();
        if (scroHei > 500) {
            $('.back-to-top').fadeIn();
            $('.back-to-top').css('top', '-200px');
        }else {
            $('.back-to-top').fadeOut();
        }
    })
    $('.back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
    })
})

